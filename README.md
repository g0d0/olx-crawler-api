
# Olx Crawler API

Allows you to query OLX and get the return in JSON.

## How to run

After install FWD, execute below command:

```
fwd start
```

## How to query

```
curl -XGET "http://localhost/api/query/sp?q=celular" -H 'Accept: application/json'
```

### Response example

```json
[
    {
        "category": "Celulares e telefonia",
        "title": "Celular",
        "href": "https://sp.olx.com.br/regiao-de-presidente-prudente/celulares/celular-734186421?xtmc=celular&amp;xtnp=1&amp;xtcr=2",
        "image": "https://img.olx.com.br/thumbs256x256/55/559003038696910.jpg",
        "region": "Araçatuba,  Residencial Águas Claras  -  DDD 18",
        "price": "R$ 30"
    },
    {
        "category": "Celulares e telefonia",
        "title": "Celular",
        "href": "https://sp.olx.com.br/sao-paulo-e-regiao/celulares/celular-734182913?xtmc=celular&amp;xtnp=1&amp;xtcr=3",
        "image": "https://img.olx.com.br/thumbs256x256/56/565003030236850.jpg",
        "region": "São Paulo,  Vila da Saúde  -  DDD 11",
        "price": "R$ 500"
    }
]
```
