##### 搜索书籍
`url：/api/v1/book`

`method:get`

| 参数|  类型  |  是否必填 |
| :---:  | :----:   | :----: |
| q   | string    |   T   |
| page   | number    |  F    |

```
正确返回:
    {
        "keyword": "9787121277139",
        "total": 1,
        "books": [
            {
                "title": "python绝技：运用python成为顶级黑客",
                "publisher": "电子工业出版社",
                "pages": "264",
                "author": "[美] TJ O'Connor",
                "summary": "Python 是一门常用的编程语言，它不仅上手容易，而且还拥有丰富的支持库。对经常需要针对自己所 处的特定场景编写专用工具的黑客、计算机犯罪调查人员、渗透测试师和安全工程师来说，Python 的这些 特点可以帮助他们又快又好地完成这一任务，以极少的代码量实现所需的功能。《Python绝技：运用Python成为顶级黑客》结合具体的场景和真 实的案例，详述了 Python 在渗透测试、电子取证、网络流量分析、无线安全、网站中信息的自动抓取、 病毒免杀等领域内所发挥的巨大作用。\\n《Python绝技：运用Python成为顶级黑客》适合计算机安全管理人员、计算机犯罪调查和电子取证人员、渗透测试人员，以及所有对计算机 安全感兴趣的爱好者阅读。同时也可供计算机、信息安全及相关专业的本/专科院校师生学习参考。",
                "image": "https://img1.doubanio.com/lpic/s28385338.jpg"
            }
        ]
    }

```
```

错误返回:
     {
         "msg": "the resource are not found 0__0...",
         "error_code": 1001,
         "url": "/api/v1/book?q="XXX"
     }
```

##### 书籍详情
`method:get`

`url:/api/v1/:idbn/bookDetail`

| 参数|  类型  |  是否必填 |
| :---:  | :----:   | :----: |
| isbn   | string    |   T   |

```
正确返回
    {
        "keyword": "9787070511209",
        "total": 1,
        "books": [
            {
                "isbn": "9787070511209",
                "title": "金庸作品集",
                "publisher": "广州出版社",
                "pages": "",
                "author": "金庸",
                "summary": "",
                "image": "https://img3.doubanio.com/lpic/s2834105.jpg",
                "pubdate": "2006-1",
                "price": "683",
                "binding": ""
            }
        ]
    }

```

```
参数错误返回
    
    {
        "msg": "disable access",
        "error_code": 1002,
        "url": "/api/v1/978707051120/bookDetail"
    }
```
```
    未搜到结果返回
        {
            "msg": "the resource are not found 0__0...",
            "error_code": 1001,
            "url": "/api/v1/book?q=9787070511200"
        }

```