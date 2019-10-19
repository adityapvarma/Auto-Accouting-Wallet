from flask import Flask,render_template,request

app = Flask(__name__)
app.config["DEBUG"] = True


@app.route('/')
def root():
    return render_template('home.html',texttc='SampleText')

@app.route('/convert',methods=['POST'])
def convert():
    if request.method=='POST':
        text=request.form['convert']

        return render_template('home.html',texttc=text)

if __name__ == "__main__":
    app.run()
