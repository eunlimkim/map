import sqlite3

if __name__ == "__main__":

    conn = sqlite3.connect("data.db")
    cursor = conn.cursor()

    #how to create db file CREATE
    sql = """CREATE TABLE 'tbl_book_status'(
        'ID' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, 
        'book_ID' INTEGER NOT NULL,
        'BOOK_TITLE' TEXT NOT NULL,
        'ZIPCODE' INT,
        'STATUS' INT,
        'store_name' TEXT NOT NULL
        );
    """

    #cursor.execute(sql)
    #when you wanna delete the table from db
    #sql = "DROP TABLE tbl_book_status"
    #how to fetch the data  SELECT

    sql = "SELECT * FROM sqlite_master WHERE type = 'table';"
    sql = """INSERT INTO tbl_book_status(book_ID, BOOK_TITLE, ZIPCODE, STATUS)
    VALUES(98372432, "byebye", 84621, 1)"""
    #r = cursor.execute(sql)
    sql =  """INSERT INTO tbl_book_status(book_ID, BOOK_TITLE, ZIPCODE, STATUS)
    VALUES(9374235, "study Python", 14682, 1)"""
    #r = cursor.execute(sql)
    sql = "SELECT * FROM tbl_book_status"

    #* means fetch all field but if you specify as book_title or zipcode, it will fetch two specific field.
    sql = """SELECT * FROM tbl_book_status
        """

    cursor.execute(sql)
    r = cursor.fetchall()
    print(r)
    # WHERE is a condition
    sql = """SELECT book_title, zipcode FROM tbl_book_status
        WHERE status = 1 AND zipcode = 14627
    """


    #sql = """
    #    DELETE FROM tbl_book_status
    #    WHERE status = 0
    #"""

    #sql = """
    #    DELETE FROM tbl_book_status
    #"""
    #r = cursor.execute(sql)
    #conn.commit()
    #r = r.fetchall()
    #everytime you need to commit
