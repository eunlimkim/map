from bs4 import BeautifulSoup
import requests
import sqlite3

class BookCrawler:
    def __init__(self):
        self.searchURL = "https://www.barnesandnoble.com/s/"
        self.availabilityURL = "https://www.barnesandnoble.com/xhr/storeList-with-prodAvailability.jsp?action=fromSearch&radius=100&searchString=14627&myBn=&skuId="
        self.top100URL = "https://www.barnesandnoble.com/b/books/_/N-1fZ29Z8q8?Nrpp=20&page="
        self.connection = sqlite3.connect("data.db")
        self.cursor = self.connection.cursor()
        self.top100_book_soup = []
        self.bookID_lists = []

    def request(self, inputURL):
        headers = {
            'User-Agent': "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Scafari/537.36"
        }
        response = requests.get(inputURL, headers=headers)
        html = response.text
        response.encoding = None
        soup = BeautifulSoup(html, features="lxml")
        return soup

    def top100_titles(self):
        booktitles = []
        for i in range(1,4):
            top100URL = self.top100URL + str(i+1)
            #url is fine
            soup = self.request(top100URL)
            book_titles_unfiltered = soup.find_all("h3", {"class" : "product-info-title"})
            book_titles = list(x.find("a").text for x in book_titles_unfiltered)
            booktitles.extend(book_titles)
        return booktitles #returns nothing

    def search_book_URL(self, bookTitle):
        #booktitles = self.top100_titles()

        #여기 for loop 안에서 책 개수 정해줌 !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

        #for book_title in booktitles:
        #    print(book_title)
        result = self.request(self.searchURL + bookTitle)
        return result

    def availability_URL(self, book_ID):
        return self.request(self.availabilityURL + book_ID)

    def get_bookID(self, soup):
        img = soup.find_all("img", {"class": "full-shadow"})
        findBookID = img[0]["src"]
        bookIDList = findBookID.split("/")
        bookID = bookIDList[-1].split("_")[0]

        return bookID

    def get_information(self, soup):
        store_infos = []
        availability_infos = []
        each_store_address = []
        store_addresses = []
        infos = soup.find_all("div" , {"class" : ["store-list"]})
        store_names= list(x.find("h3", {"class": "store-name"}).text for x in infos)
        store_addresses_soup = list(soup.find("form", {"id" : "storeSelectorForm_" + str(j)}) for j in range (1,6))

        get_store_address = list(x.find_all("p", {"class" : "mt-0"}) for x in store_addresses_soup)
        #each_store_address = list(get_store_address[i][:3] for i in range(len(get_store_address)))

        for i in range(len(get_store_address)):
            each_store_address = list(get_store_address[i][:2])
            store_address = []
            for j in range(len(each_store_address)):
                store_address.append(each_store_address[j].text)
            store_addresses.append(store_address)

        print("store address " , store_addresses)

        #print("this is the address", each_store_address)
        #for store_address in get_store_address:
        #    i = 0
        #    store_address = get_store_address[i]

        locations = []

        for place, address in store_addresses:
            url = f"https://maps.googleapis.com/maps/api/place/textsearch/json?query=barnesandnoble {place} {address} rochester&key=AIzaSyClInRGo2UKehFPRxlsozWlR1xe5NcT7n8"
            print(place,address)

            json = requests.get(url).json()
            try:
                lat = json["results"][0]["geometry"]["location"]['lat']
                lng = json["results"][0]["geometry"]["location"]['lng']
                locations.append((lat, lng))
            except:
                locations.append((0, 0))

        print(locations)
        #print(list(len(x) for x in store_address))
        #get_store_address = list(x[1].text + " " + x[2].text for x in store_address)
        #print(get_store_address)
        #store_addresses = list(x.find_all("p", {"class" : "mt-0 mb-0"}))
        #정보의 순서가 같기때문에 availability를 찾으려면 -1해줘서 맨 마지막 p만 가져오면 된다

        book_status = list(x.find_all("p")[-1].text for x in infos)
        book_status = list(0 if x == "Not in Stock in Store" else 1 for x in book_status)
        return list(zip(store_names, book_status,locations))

    def DB_insert(self):
        titles = self.search_book_URL()
        book_infos = []
        print("start")
        i = 0
        c = 0
        title_ID_dict = {}
        for soup in self.top100_book_soup:
            try :
                bookID = self.get_bookID(soup)
                title_ID_dict[bookID] = titles[c]
                self.bookID_lists.append(bookID)
                print(title_ID_dict)
            except Exception as e :
                print("fail")
            c += 1
        for bookID in self.bookID_lists:
            a = self.availability_URL(bookID)
            s = self.get_information(a)
            book_infos.append(s)
            #print(s)

       #print(book_infos)
        # unpacking
        i = 0
        sql = """
            DELETE FROM tbl_book_status
         """
        #self.cursor.execute(sql)
        for bookID in self.bookID_lists:
            book_name = title_ID_dict[bookID]

            for store_name, status, location in book_infos[i]:
                lat,lng = location

                sql = f"""
                            INSERT INTO books_bookstatus( book_ID, BOOK_TITLE, ZIPCODE, STATUS, store_name,lat,lng)
                        VALUES({bookID}, "{book_name}", 14627, {status} , "{store_name}",{lat},{lng})
                        """

                self.cursor.execute(sql)
                self.connection.commit()

                print(sql)
            i += 1

    def get_books(self, book_title):
        soup = self.search_book_URL(book_title)
        bookID = self.get_bookID(soup)
        available_books = self.availability_URL(bookID)
        book_infos = self.get_information(available_books)

        return book_infos

if __name__ == "__main__":

    c = BookCrawler()
    #c.DB_insert()#
  #  c.top100_titles(c.top100URL)
    soup = c.search_book_URL("Harry Potter")
    #print(soup)
    bookID = c.get_bookID(soup)
    #print(bookID)
    available_books = c.availability_URL(bookID)
    #print(available_books)
    book_infos = c.get_information(available_books)
    print(book_infos)

#14627 주변의 bookstore에서 top 100 book status 가져오기