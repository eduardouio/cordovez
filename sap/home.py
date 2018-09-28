from bottle import response
from bottle import get, run
import json
from Model import Model


@get('/<enterprise>/<year>/')
def getOrders(enterprise, year):
    response.headers['Content-Type'] = 'application/json'
    response.headers['Cache-Control'] = 'no-cache'
    model_db = Model(enterprise,year)
    data = model_db.get_data()
    return json.dumps({'data' : data })


if __name__ == '__main__':
    run(host='127.0.0.1', port=8000, debug=True)
