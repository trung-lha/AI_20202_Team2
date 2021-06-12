import json
import os

with open("data/pushup/train.json", "r") as fp:
    train1 = json.load(fp)
    for l in train1:
        l["is_pushing_up"] = True
with open("data/mpii/train.json", "r") as fp:
    train2 = json.load(fp)
    for l in train2:
        x = l["points"]
        l["points"] = [x[10], x[11], x[12], x[9], x[13], x[14], x[15]]
        x = l["visibility"]
        l["visibility"] = [x[10], x[11], x[12], x[9], x[13], x[14], x[15]]
        l["is_pushing_up"] = False

with open("data/pushup/val.json", "r") as fp:
    val1 = json.load(fp)
    for l in val1:
        l["is_pushing_up"] = True
with open("data/mpii/val.json", "r") as fp:
    val2 = json.load(fp)
    for l in val2:
        x = l["points"]
        l["points"] = [x[10], x[11], x[12], x[9], x[13], x[14], x[15]]
        x = l["visibility"]
        l["visibility"] = [x[10], x[11], x[12], x[9], x[13], x[14], x[15]]
        l["is_pushing_up"] = False

with open("data/pushup/test.json", "r") as fp:
    test1 = json.load(fp)
    for l in test1:
        l["is_pushing_up"] = True
with open("data/mpii/test.json", "r") as fp:
    test2 = json.load(fp)
    for l in test2:
        x = l["points"]
        l["points"] = [x[10], x[11], x[12], x[9], x[13], x[14], x[15]]
        x = l["visibility"]
        l["visibility"] = [x[10], x[11], x[12], x[9], x[13], x[14], x[15]]
        l["is_pushing_up"] = False

os.system("mkdir -p data/mpii_pushup/images")
with open("data/mpii_pushup/train.json", "w") as fp:
    json.dump(train1 + train2, fp)
with open("data/mpii_pushup/val.json", "w") as fp:
    json.dump(val1 + val2, fp)
with open("data/mpii_pushup/test.json", "w") as fp:
    json.dump(test1 + test2, fp)

os.system("cp data/pushup/images/* data/mpii_pushup/images")
os.system("cp data/mpii/images/* data/mpii_pushup/images")