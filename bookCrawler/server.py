from flask import Flask
from flask import request as req
from bookCrawler import BookCrawler
from flask import jsonify, json
import folium
import pandas as pd
import io
from PIL import Image
import sys
import numpy as np
from folium import plugins

#create flask object
app = Flask(__name__)

c = BookCrawler()

df = pd.read_csv("latitude_altitude.csv")

# create a route to getbook http://localhost:7000/getbook
import urllib
#"POST", "GET"
@app.route('/getbook', methods=["GET","POST"])
def getbook():
    data = req.data.decode('utf8')
    data = urllib.parse.unquote_plus(data)

    tokens = data.split("&")

    title = tokens[0].split("=")[-1]
    zipcode = tokens[1].split("=")[-1]

    infos = c.get_books(title, zipcode)
    m = folium.Map(location= infos[1][-1], zoom_start=10)

    for store in infos:
        folium.Marker(location = store[-1], icon = folium.Icon(color='green')).add_to(m)

    return m._repr_html_()


@app.route('/gethos', methods=["GET","POST"])
def gethos():

    let = df.iloc[0, 2]
    let2 = df.iloc[0, 3]
    m = folium.Map(location=[let, let2], zoom_start=12)

    N = 100

    data = df[["latitude", "longitude"]].values

    # popups = [str(i) for i in range(N)] # Popups texts are simple numbers.
    m = folium.Map([let, let2], zoom_start=7)
    plugins.MarkerCluster(data).add_to(m)

    return m._repr_html_()


if __name__ == "__main__":
    app.run(host="0.0.0.0", port=7000)
#flask의 일은 port 7000에서 대기를 하고 있다가 getbook이라는 URL "http://localhost:7000/getbook" 으로 들어오면 안에 있는 작업 (getbook)을 함