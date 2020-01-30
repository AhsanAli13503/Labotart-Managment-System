from difflib import SequenceMatcher

def read_dataset():
    data1=[]
    data2=[]
    with open("Data//BadWords.txt") as fp:
        data=fp.readlines()
        for abc in data:
            data1.append(abc)
    with open("Data//GoodWords.txt") as fp:
        data=fp.readlines()
        for abc in data:
            data1.append(abc)

    return data1,data2

def similar(a,b):
    return SequenceMatcher(None, a, b).ratio()

def predict(word):
    data1,data2= read_dataset()
    ratio1=[]
    ratio2=[]
    for i in range (len(data1)):
        ratio1.append(similar(data1[i],word))
    
    for i in range (len(data2)):
        ratio2.append(similar(data2[i],word))
    if max(ratio1)>max(ratio2):
        return "BadWord"
    else:
        return "GoodWord"

