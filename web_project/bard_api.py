from bardapi import Bard
import os
import sys
import requests
# set your __Secure-1PSID value to key
token = 'XwiIk91u9POPpCQYlPZt4-xdzAyMT4KdHGSxI-I303naZepqfZdrLVfrxzCFw_OOJz8Jtg.'
input_text_array = sys.argv[1].split("%")
input_text=""
for x in input_text_array:
    input_text = input_text+" "+x
    
os.environ['_BARD_API_KEY']=token
session = requests.Session()
session.headers = {
            "Host": "bard.google.com",
            "X-Same-Domain": "1",
            "User-Agent": "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36",
            "Content-Type": "application/x-www-form-urlencoded;charset=UTF-8",
            "Origin": "https://bard.google.com",
            "Referer": "https://bard.google.com/",
        }
session.cookies.set("__Secure-1PSID", os.environ["_BARD_API_KEY"])

bard = Bard(session=session)
print(bard.get_answer(input_text)['content'])