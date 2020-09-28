from flask import Flask
from flask import request as req
from bookCrawler import BookCrawler
from flask import jsonify, json
import folium
import pandas as pd
import io
from PIL import Image

#create flask object
app = Flask(__name__)

c = BookCrawler()

# create a route to getbook http://localhost:7000/getbook

#"POST", "GET"
@app.route('/getbook', methods=["GET"])
def getbook():
    title = req.args.get("book_title")
    infos = c.get_books(title)
    m = folium.Map(location= infos[0][-1], zoom_start=12)
    for store in infos:
        folium.Marker(location = store[-1], icon = folium.Icon(color='green')).add_to(m)

    return m._repr_html_()

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=7000)
#flask의 일은 port 7000에서 대기를 하고 있다가 getbook이라는 URL "http://localhost:7000/getbook" 으로 들어오면 안에 있는 작업 (getbook)을 함