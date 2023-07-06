from unittest import result
from pytube import YouTube
import json
import sys
result = sys.argv[1]
yt = YouTube(result)
json_decord = {"title": yt.title,"thumbnail": yt.thumbnail_url, "videos_url": yt.streaming_data}
print(json.dumps(json_decord))