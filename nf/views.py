from django.shortcuts import render,redirect
import pymongo
# Create your views here.

def index(request):
    if request.method=="POST":
        search=request.POST.get('inpt').capitalize()
        # print(search)
        client=pymongo.MongoClient('mongodb://localhost:27017')
        db=client['nutrifacts']
        coll=db['fruits_vegies']    
        getinfo=coll.find({"name":search})
        viewinfo={'getinfo':getinfo}
        # print(getinfo)
        return render(request,'index.html',viewinfo)
    else:
        return render(request,'index.html')
    