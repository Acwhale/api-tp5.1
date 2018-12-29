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
                "summary": " 是一门常用的编程语言，它不仅上手容易，而且还拥有丰富的支持库。对经常需要针对自己所 处的特定场景编写专用工具的黑客、计算机犯罪调查人员、渗透测试师和安全工程师来说，Python 的这些 特点可以帮助他们又快又好地完成这一任务，以极少的代码量实现所需的功能。《Python绝技：运用Python成为顶级黑客》结合具体的场景和真 实的案例，详述了 Python 在渗透测试、电子取证、网络流量分析、无线安全、网站中信息的自动抓取、 病毒免杀等领域内所发挥的巨大作用。\\n《Python绝技：运用Python成为顶级黑客》适合计算机安全管理人员、计算机犯罪调查和电子取证人员、渗透测试人员，以及所有对计算机 安全感兴趣的爱好者阅读。同时也可供计算机、信息安全及相关专业的本/专科院校师生学习参考。",
                "image": "https://img1.doubanio.com/lpic/s28385338.jpg"
            }
        ]
    }

```
```

错误返回:PythonPython
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
##### 用户注册
`url: api/v1/client`

`method:post`

| 参数|  类型  |  是否必填 |
| :---:  | :----:   | :----: |
| type   | number    |   T   |
| account   | string    |   T   |
| secret   | string    |   T   |
| nickname   | string    |   T   |

```
    正确返回
    {
        "code": 201,
        "msg": "OK",
        "errCode": "0"
    }
    错误返回
    {
        "code": 409,
        "msg": "create resource failed",
        "errCode": 20000
    }
```
##### 用户登录
`url:api/v1/login`

`method:post`

| 参数|  类型  |  是否必填 |
| :---:  | :----:   | :----: |
| type   | number    |   T   |
| account   | string    |   T   |
| secret   | string    |   T   |

```
    正确返回
           {
               "token": "03ee12954af16d0c02e518f4176bd0f1"
           }
    错误返回
            {
                "code": 404,
                "msg": "the resource are not found 0__0...",
                "error_code": 1001,
                "url": "/api/v1/login"
            }
        
```
##### 获取用户token

`url:api/v1/user/token`

`method:post`

| 参数|  类型  |  是否必填 |  位置  |
| :---:  | :----:   | :----: | :----: |
| toke   | string    |   T   | header |

```
    正确返回：
        {
            "id": 36
        }
    错误返回
       {
           "code": 401,
           "msg": "无效token或者token失效",
           "error_code": 10001,
           "url": "/api/v1/user/token?XDEBUG_SESSION_START=12513"
       }
```

##### 获取最近礼物

`url:api/v1/gift/recent`

`method:get`

```
    正确结果：
        [
            {
                "keyword": "9787532730001",
                "total": 1,
                "books": [
                    {
                        "isbn": "9787532730001",
                        "title": "世界尽头与冷酷仙境",
                        "publisher": "上海译文出版社",
                        "pages": "450",
                        "author": "[日]村上春树",
                        "summary": "《世界尽头与冷酷仙境》是村上春树最重要的小说之一，与《挪威的森林》、《舞舞舞》合称为村上春树三大杰作。小说共40章，单数20章“冷酷仙境”，双数20章为“世界尽头”，这种交叉平行地展开故事情节的手法是村上春树小说的特征，而这部作品是这种特征最典型的体现。“冷酷仙境”写两大黑社会组织在争夺一个老科学家发明的控制人脑的装置，老人躲到了地底。主人公“我”是老人的实验对象，他受到黑社会的恐吓，在老人的孙女帮助下，经过了惊心动魄的地底之旅，好容易找到老人，却被告知由于老人的计算错误，他24小时后离开人世，转往另一世界即“世界尽头”。“我”回到地面上, 与女友过了最后一夜告别，然后驱车到海边静候死的到来。“世界尽头”是另一番景象，这里与世隔绝，居民相安无事，但人们没有心，没有感情，没有目标。“我”一直想逃离这里，但在即将成功时选择了留下，因为“我”发现“世界尽头”其实是“我”自己造出的。书中想象力奇特，艺术水准高超，情节极其荒诞而主题极其严肃，用变形的手法写出人们对当代资本主义社会的混乱现状逃避无门的真实心态。",
                        "image": "https://img1.doubanio.com/lpic/s1801057.jpg",
                        "pubdate": "2002-12",
                        "price": "23.00元",
                        "binding": "平装"
                    }
                ]
            },
        ]
        错误结果：[]
```

##### 获取想要我的书籍的心愿清单

`url:api/v1/gift/:id/my`

`method:get`

```
    正确结果
    [
        {
            "keyword": "9787544247252",
            "total": 1,
            "books": [
                {
                    "isbn": "9787544247252",
                    "title": "1Q84 BOOK 2",
                    "publisher": "南海出版公司",
                    "pages": "352",
                    "author": "[日]村上春树",
                    "summary": "1Q84简体中文版官方网站：http://www.douban.com/minisite/1q84/\\n今年夏天，属于1Q84年。\\n在1984年，他们连相遇的机会都没有，只能一面思念着对方，一面孤独地远去。\\n在1Q84年，他们却决定拯救彼此……\\n“不管喜欢还是不喜欢，目前我已经置身于这‘1Q84年’。我熟悉的那个1984年已经无影无踪，今年是1Q84年。空气变了，风景变了。我必须尽快适应这个带着问号的世界。像被放进陌生森林中的动物一样，为了生存下去，得尽快了解并顺应这里的规则。”\\n《1Q84》写一对十岁时相遇后便各奔东西的三十岁男女，相互寻觅对方的故事，并将这个简单故事变成复杂的长篇。我想将这个时代所有世态立体地写出，成为我独有的“综合小说”。超越纯文学这一类型，采取多种尝试。在当今时代的空气中嵌入人类的生命。——村上春树",
                    "image": "https://img3.doubanio.com/lpic/s4393610.jpg",
                    "pubdate": "2010-6",
                    "price": "36.00元",
                    "binding": "精装"
                }
            ],
            "wishes": 2
        },
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
            ],
            "wishes": 1
        }
    ]
    错误结果
        []
```
##### 邮件重置密码

`method:post`

`url:api/v1/user/reset`

| 参数|  类型  |  是否必填 |  位置  |
| :---:  | :----:   | :----: | :----: |
| token   | string    |   T   | header |

```
    正确返回
       
           {
               "code": 201,
               "msg": "请在邮件中查询你的新密码",
               "errCode": "0"
           } 
    
    错误返回 
        {
            'code':200,
            'msg':'请稍后重试',
            'errCode':10009
        }

```