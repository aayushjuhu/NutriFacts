from flask import Flask, render_template,request,session,redirect,url_for
from flask_sqlalchemy import SQLAlchemy
import bcrypt
import pymongo
app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI']='sqlite:///<db name>.db'
db=SQLAlchemy(app)
app.config['SECRET_KEY']=""

class User(db.Model):
	id=db.Column(db.Integer,primary_key=True)
	name=db.Column(db.String(50), nullable=False)
	email=db.Column(db.String(50), unique=True)
	password=db.Column(db.String(100), nullable=False)

	def __init__(self,email,password,name):
		self.email=email
		self.name=name
		self.password=bcrypt.hashpw(password.encode('utf-8'), bcrypt.gensalt()).decode('utf-8')
	
	def checkpw(self, password):
		return bcrypt.checkpw(password.encode('utf-8'),self.password.encode('utf-8'))

with app.app_context():
    db.create_all()      


@app.route('/',methods=['GET','POST'])
def start():
	if 'email' in session and session['email']:
		return redirect(url_for('index'))
	return render_template('login.html')

@app.route('/home', methods=['GET','POST'])
def index():
	if 'email' in session and session['email']:
		user=User.query.filter_by(email=session['email']).first()
		username=user.name # type: ignore
		if request.method == "POST":
			search = request.form['inpt']
			search=search.capitalize()
			client = pymongo.MongoClient('mongodb://localhost:27017')
			db = client['nutrifacts']
			coll = db['fruits_vegies']
			getinfo = coll.find_one({"name": search})
			return render_template('index.html', getinfo=getinfo, user=username)	
		else:
			return render_template('index.html',user=username)
	else:
		return redirect(url_for('start'))

@app.route('/register', methods=['GET','POST'])
def reg():
	if request.method=='POST':
		name=request.form['name']
		email=request.form['email']
		password=request.form['password']
		new_user=User(name=name,email=email,password=password)
		db.session.add(new_user)
		db.session.commit()
		print(name+" "+email+" "+" "+password)
		return redirect('/')
	return redirect(url_for('start'))

@app.route('/login', methods=['GET','POST'])
def login():
	if request.method=="POST":
		email=request.form['email']
		password=request.form['password']
		user=User.query.filter_by(email=email).first()
		if user and user.checkpw(password):
			session['email']= email
			return redirect('/home')
		else:
			# flash("Email or Password is incorrect", 'danger')
			return render_template('login.html')
	return redirect('/')

@app.route('/logout', methods=['GET','POST'])
def logout():
	session.pop('email',None)
	return redirect('/')

if __name__ == '__main__':
	app.run(debug=True)