<?php 
平台推荐
 推荐注册分成  按后台设置的等级比例
 推荐订单分成  按订单的parent_id 订单金额的此百分比部分作为分成用金额,后台 现金分成总额百分比
手机版推荐
 手机后台设置
 按订单 跟 按商品 

'
1.account_log 用户账目日志表
字段  类型  Null/默认     注释
log_id  mediumint(8)    否 /     自增 ID 号
user_id     mediumint(8)    否 /     用户登录后保存在session中的id号,跟users表中user_id对应
user_money  decimal(10,2)   否 /     用户该笔记录的余额
frozen_money    decimal(10,2)   否 /     被冻结的资金
rank_points     mediumint(9)    否 /     等级积分,跟消费积分是分开的
pay_points  mediumint(9)    否 /     消费积分,跟等级积分是分开的
change_time     int(10)     否 /     该笔操作发生的时间
change_desc     varchar(255)    否 /     该笔操作的备注
change_type     tinyint(3)  否 /     操作类型,0为充值,1,为提现,2为管理员调节,99为其它类型

2.ad 广告表
字段  类型  Null/默认     注释
ad_id   smallint(5)     否 /     自增ID号
position_id     smallint(5)     否 / 0   0,站外广告;从1开始代表的是该广告所处的广告位,同表ad_postition中的字段position_id的值
media_type  tinyint(3)      否 / 0   广告类型,0图片;1flash;2代码3文字
ad_name     varchar(60)     否 /     该条广告记录的广告名称
ad_link     varchar(255)    否 /     广告链接地址
ad_code     text    否 /     广告链接的表现,文字广告就是文字或图片和flash就是它们的地址
start_time  int(11)     否 / 0   广告开始时间
end_time    int(11)     否 / 0   广告结速时间
link_man    varchar(60)     否 /     广告联系人
link_email  varchar(60)     否 /     广告联系人的邮箱
link_phone  varchar(60)     否 /     广告联系人的电话
click_count     mediumint(8)    否 / 0   该广告点击数
enabled     tinyint(3)  否 / 1   该广告是否关闭;1开启; 0关闭; 关闭后广告将不再有效

3.admin_action 管理权限分配
字段  类型  Null/默认     注释
action_id   tinyint(3)      否 /     自增ID号
parent_id   tinyint(3)      否 / 0   该id 项的父id,对应本表的action_id字段
action_code     varchar(20)     否 /     代表权限的英文字符串,对应汉文在语言文件中,如果该字段有某个字符串,就表示有该权限
relevance   varchar(20)     否 /      

4.admin_log  管理日志
字段  类型  Null/默认     注释
log_id  int(10)     否 /     自增ID号
log_time    int(10)     否 / 0   写日志时间
user_id     tinyint(3)      否 / 0   该日志所记录的操作者id,同admin_user的user_id
log_info    varchar(255)    否 /     管理操作内容
ip_address  varchar(15)     否 /     登录者登录IP

5.admin_message  管理留言 
字段  类型  Null/默认     注释
message_id  smallint(5)     否 /     自增id号
sender_id   tinyint(3)      否 / 0   发送该留言的管理员id,同admin_user的user_id
receiver_id     tinyint(3)      否 / 0   接收消息管理员id,同admin_user的user_id,如果是给多个管理员发送,则同一个消息给每个管理员id发送一条
sent_time   int(11)     否 / 0   留言发送时间
read_time   int(11)     否 / 0   留言阅读时间
readed  tinyint(1)      否 / 0   留言是否阅读1已阅读;0未阅读
deleted     tinyint(1)      否 / 0   留言是否已经被删除 1已删除;0未删除
title   varchar(150)    否 /     留言的主题
message     text    否 /     留言的内容

6.admin_user  管理员管理
字段  类型  Null/默认     注释
user_id     smallint(5)     否 /     自增id号,管理员代码
user_name   varchar(60)     否 /     管理员登录名
email   varchar(60)     否 /     管理员邮箱
password    varchar(32)     否 /     管理员登录密码
add_time    int(11)     否 /     管理员添加时间
last_login  int(11)     否 /     管理员最后一次登录时间
last_ip     varchar(15)     否 /     管理员最后一次登录IP
action_list     text    否 /     管理员管理权限列表
nav_list    text    否 /     管理员导航栏配置项
lang_type   varchar(50)     否 /      
agency_id   smallint(5)     否 /     该管理员负责的办事处理的id,同agency的agency_id字段.如果管理员没有负责办事处,则此处为0
suppliers_id    smallint(5)     是 / 0    
todolist    longtext    是 /     记事本记录的数据
role_id     smallint(5)     是 /      

7.adsense  广告相关统计
字段  类型  Null/默认     注释
from_ad     smallint(5)     否 / 0   广告代号,-1是部外广告,如果是站内广告则为ad的ad_id
referer     varchar(255)    否 /     页面来源
clicks  int(10)     否 / 0   点击率

8.ad_custom  
字段  类型  Null/默认     注释
Ad_id   Mediumint(8)    否 /      
Ad_type     Tinyint(1)  否 / 1    
Ad_name     Varchar(60)     是 /      
Add_time    Int(10)     否 / 0    
Content     Mediumtext  是 /      
url     Varchar(255)    是 /      
Ad_status   Tinyint(3)  否 / 0    

9.ad_position  广告位
字段  类型  Null/默认     注释
position_id     tinyint(3)      否 /     广告位自增id
position_name   varchar(60)     否 /     广告位名称
ad_width    smallint(5)     否 / 0   广告位宽度
ad_height   smallint(5)     否 / 0   广告高度
position_desc   varchar(255)    否 /     广告位描述
position_style  text    否 /     广告位模板代码

10.affiliate_log  管理日志
字段  类型  Null/默认     注释
log_id  mediumint(8)    否 /      
order_id    mediumint(8)    否 /     顺序ID
time    int(10)     否 /     时间
user_id     mediumint(8)    否 /     用户ID
user_name   varchar(60)     是 /     用户名
money   decimal(10,2)   否/0.00  钱
point   int(10)     否 / 0   积分
separate_type   tinyint(1)  否 / 0   特殊说明

11.agency  办事处信息
字段  类型  Null/默认     注释
agency_id   smallint(5)     否 /     办事处ID
agency_name     varchar(255)    否 /     办事处名字
agency_desc     text    否 /     办事处描述

12.area_region  记录配送区域关联id
字段  类型  Null/默认     注释
shipping_area_id    smallint(5)     否 / 0   配送区域的id 号,等同shipping_area的shipping_area_id的值
region_id   smallint(5)     否 / 0   地区列表,等同于ecs_region的region_id

13.article  文章内容
字段  类型  Null/默认     注释
article_id  mediumint(8)    否 /     自增ID号
cat_id  smallint(5)     否 / 0   该文章的分类,同article_cat的cat_id,如果不在,将自动成为保留类型而不能删除
title   varchar(150)    否 /     文章题目
content     longtext    否 /     文章内容
author  varchar(30)     否 /     文章作者
author_email    varchar(60)     否 /     文件作者的email
keywords    varchar(255)    否 /     文章的关键字
article_type    tinyint(1)      否 / 2   文章类型
is_open     tinyint(1)      否 / 1   是否显示;1显示;0不显示 
add_time    int(10)     否 / 0   文章添加时间
file_url    varchar(255)    否 /     上传文件或者外部文件的url
open_type   tinyint(1)      否 / 0   0,正常; 当该字段为1或2时,会在文章最后添加一个链接’相关下载’,连接地址等于file_url的值;但程序在此处有Bug
link    varchar(255)    否 /     该文章标题所引用的连接,如果该项有值将不能显示文章内容,即该表中content的值
description     varchar(255)    是 /      

14.article_cat  文章分类信息
字段  类型  Null/默认     注释
cat_id      smallint(5)     否   自增ID
cat_name    varchar(255)    否   分类名称
cat_type    tinyint(1)      否   分类类型 1,普通分类2,系统分类 3,网店信息 4, 帮助分类 5,网店帮助
keywords    varchar(255)    否   分类关键字
cat_desc    varchar(255)    否   分类说明文字
sort_order      tinyint(3)      否   分类显示顺序
show_in_nav     tinyint(1)      否   是否在导航栏显示 0 否 ;  1 是
parent_id   smallint(5)     否   父节点id，取值于该表cat_id字段

15.attribute  商品类型属性
字段  类型  Null/默认     注释
attr_id     smallint(5)     否 /     自增 ID
cat_id  smallint(5)     否 / 0   商品类型 , 同goods_type的 cat_id
attr_name   varchar(60)     否 /     属性名称
attr_input_type     tinyint(1)      否 / 1   当添加商品时,该属性的添加类别; 0为手功输入;1为选择输入;2为多行文本输入
attr_type   tinyint(1)      否 / 1   属性是否多选; 0否; 1是 如果可以多选,则可以自定义属性,并且可以根据值的不同定不同的价
attr_values     text    否 /     即选择输入,则attr_name对应的值的取值就是该这字段值 
attr_index  tinyint(1)      否 / 0   属性是否可以检索;0不需要检索; 1关键字检索2范围检索,该属性应该是如果检索的话,可以通过该属性找到有该属性的商品
sort_order  tinyint(3)      否 / 0   属性显示的顺序,数字越大越靠前,如果数字一样则按id顺序
is_linked   tinyint(1)      否 / 0   是否关联,0 不关联 1关联; 如果关联, 那么用户在购买该商品时,具有有该属性相同的商品将被推荐给用户
attr_group  tinyint(1)      否 / 0   属性分组,相同的为一个属性组应该取自goods_type的attr_group的值的顺序.

16.auction_log  拍卖出价记录表
字段  类型  Null/默认     注释
log_id  mediumint(8)    否   自增ID号
act_id  mediumint(8)    否   拍卖活动的id,取值于goods_activity的act_id字段
bid_user    mediumint(8)    否   出价的用户id,取值于users的user_id
bid_price   decimal(10,2)   否   出价价格
bid_time    int(10)     否   出价时间

17.auto_manage 处理文章，商品自动上下线的计划任务列表（需要安装计划任务插件）
字段  类型  Null/默认     注释
item_id     mediumint(8)    否   如果是商品就是goods的goods_id,如果是文章就是article的article_id
type    varchar(10)     否   Goods是商品,article是文章
starttime   int(10)     否   上线时间
endtime     int(10)     否   下线时间 

18.back_goods  
字段  类型  Null/默认     注释
Rec_id  mediumint(8)    否 /      
Back_id     mediumint(8)    是 / 0    
Goods_id    mediumint(8)    否 / 0    
Product_id  mediumint(8)    否 / 0    
Product_sn  Vatchar(60)     是 /      
Goods_name  Vatchar(120)    是 /      
Brand_name  Vatchar(60)     是 /      
Goods_sn    Vatchar(60)     是 /      
Is_real     Tinyint(1)  是 / 0    
Send_number     Smallint(5)     是 / 0    
Goods_attr  Test    是 /      

19.back_order  
字段  类型  Null/默认     注释
back_id     mediumint(8)    否    
delivery_sn     varchar(20)     否    
order_sn    varchar(20)     否    
order_id    mediumint(8)    否    
invoice_no  varchar(50)     是    
add_time    int(10)     是    
shipping_id     tinyint(3)  是    
shipping_name   varchar(120)    是    
user_id     mediumint(8)    是    
action_user     varchar(30)     是    
consignee   varchar(60)     是    
address     varchar(250)    是    
country     smallint(5)     是    
province    smallint(5)     是    
city    smallint(5)     是    
district    smallint(5)     是    
sign_building   varchar(120)    是    
email   varchar(60)     是    
zipcode     varchar(60)     是    
tel     varchar(60)     是    
mobile  varchar(60)     是    
best_time   varchar(120)    是    
postscript  varchar(255)    是    
how_oos     varchar(120)    是    
insure_fee  decimal(10,2)   是    
shipping_fee    decimal(10,2)   是    
update_time     int(10)     是    
suppliers_id    smallint(5)     是    
status  tinyint(1)  否    
return_time     int(10)     是    
agency_id   smallint(5)     是    

20.bonus_type  红包类型表
字段  类型  Null/默认     注释
type_id     smallint(5)     否 /     红包类型流水号
type_name   varchar(60)     否 /     红包名称
type_money  decimal(10,2)   否/0.00  红包所值的金额
send_type   tinyint(3)      否 / 0   红包发送类型0按用户如会员等级,会员名称发放;1按商品类别发送;2按订单金额所达到的额度发送;3线下发送
min_amount  decimal(10,2)   否/0.00  如果按金额发送红包,该项是最小金额,即只要购买超过该金额的商品都可以领到红包 
max_amount  decimal(10,2)   否/0.00   
send_start_date     int(11)     否 / 0   红包发送的开始时间
send_end_date   int(11)     否 / 0   红包发送的结束时间
use_start_date  int(11)     否 / 0   红包可以使用的开始时间
use_end_date    int(11)     否 / 0   红包可以使用的结束时间
min_goods_amount    decimal(10,2)   否0.00   可以使用该红包的商品的最低价格,即只要达到该价格商品才可以使用红包
21.booking_goods  缺货登记的订购和处理记录表

字段  类型  Null/默认     注释
rec_id  mediumint(8)    否 /     自增ID号
user_id     mediumint(8)    否 / 0   登记该缺货记录的用户的id,取值user的user_id
email   varchar(60)     否 /     页面填的用户的email,默认取值于user的email
link_man    varchar(60)     否 /     页面填的用户的电话,默认取值于users的consignee
tel     varchar(60)     否 /     页面填的用户电话,默认取值于user的tel
goods_id    mediumint(8)    否 / 0   缺货登记商品id,取值于goods的goods_id
goods_desc  varchar(255)    否 /     缺货登记时留的订购描述
goods_number    smallint(5)     否 / 0   订购数量
booking_time    int(10)     否 / 0   缺货登记的时间
is_dispose  tinyint(1)      否 / 0   是否已经被处理
dispose_user    varchar(30)     否 /     处理该缺货登记的管理员用户名,取值于session,该session取值于admin_user的user_name
dispose_time    int(10)     否 / 0   处理的时间
dispose_note    varchar(255)    否 /     处理时间管理员留的备注

22.brand  商品品牌表
字段  类型  Null/默认     注释
brand_id    smallint(5)     否 /     自增id号
brand_name  varchar(60)     否 /     品牌名称
brand_logo  varchar(80)     否 /     上传的该公司Logo图片
brand_desc  text    否 /     品牌描述
site_url    varchar(255)    否 /     品牌的网址
sort_order  tinyint(3)      否 / 0   品牌在前台页面的显示顺序,数字越大越靠后
is_show     tinyint(1)      否 / 1   该品牌是否显示;0否1显示

23.card   贺卡的配置的信息
字段  类型  Null/默认     注释
card_id     tinyint(3)      否 /     自增id号
card_name   varchar(120)    否 /     贺卡名称
card_img    varchar(255)    否 /     贺卡图纸的名称
card_fee    decimal(6,2)    否 /     贺卡所需费用
free_money  decimal(6,2)    否/0.00  订单达到该字段的值后使用此贺卡免费
card_desc   varchar(255)    否/0.00  贺卡描述

24.cart  购物车购物信息记录表
字段  类型  Null/默认     注释
rec_id  mediumint(8)    否   自增id号
user_id     mediumint(8)    否   用户登录ID;取自session
session_id  char(32)    否   如果该用户退出,该Session_id对应的购物车中所有记录都将被删除
goods_id    mediumint(8)    否   商品的ID,取自表goods的goods_id
goods_sn    varchar(60)     否   商品的货号,取自表goods的goods_sn
product_id  mediumint(8)    否    
goods_name  varchar(120)    否   商品名称,取自表goods的goods_name
market_price    decimal(10,2)   否   商品的本店价,取自表市场价
goods_price     decimal(10,2)   否   商品的本店价,取自表goods的shop_price
goods_number    smallint(5)     否   商品的购买数量,在购物车时,实际库存不减少
goods_attr  text    否   商品的扩展属性, 取自goods的extension_code
is_real     tinyint(1)      否   取自ecs_goods的is_real
extension_code  varchar(30)     否   商品的扩展属性,取自goods的extension_code
parent_id   mediumint(8)    否   该商品的父商品ID,没有该值为0,有的话那该商品就是该id的配件
rec_type    tinyint(1)      否   购物车商品类型;0普通;1团够;2拍卖;3夺宝奇兵
is_gift     smallint(5)     否   是否赠品,0否;其他, 是参加优惠活动的id,取值于favourable_activity的act_id
is_shipping     tinyint(1)  否    
can_handsel     tinyint(3)      否   能否处理
goods_attr_id   mediumint(8)    否   该商品的属性的id,取自goods_attr的goods_attr_id,如果有多个,只记录了最后一个,可能是bug

25.category  商品分类表，记录商品分类信息
字段  类型  Null/默认     注释
cat_id  smallint(5)     否   自增id号
cat_name    varchar(90)     否   分类名称
keywords    varchar(255)    否   分类的关键字,可能是为了搜索
cat_desc    varchar(255)    否   分类描述
parent_id   smallint(5)     否 / 0   该分类的父类ID,取值于该表的cat_id字段
sort_order  tinyint(1)      否 / 0   该分类在页面显示的顺序,数字越大顺序越靠后,同数字,id在前的先显示
template_file   varchar(50)     否   不确定字段,按名和表设计猜,应该是该分类的单独模板文件的名字
measure_unit    varchar(15)     否   该分类的计量单位
show_in_nav     tinyint(1)  否 / 0   是否显示在导航栏,0不;1显示
style   varchar(150)    否   该分类的单独的样式表的包括文件部分的文件路径
is_show     tinyint(1)      否 / 1   是否在前台页面显示 1显示; 0不显示
grade   tinyint(4)  否 / 0   该分类的最高和最低价之间的价格分级,当大于1时,会根据最大最小价格区间分成区间,会在页面显示价格范围,如0-300,300-600,600-900这种; 
filter_attr     smallint(6)     否 / 0   如果该字段有值,则该分类将还会按照该值对应在表goods_attr的goods_attr_id所对应的属性筛选，如，封面颜色下有红，黑分类筛选

26.cat_recommend  
字段  类型  Null/默认     注释
Cat_id  Smallint(5)     否 /      
Recommend_type  Tinyint(1)  否  /     

27.collect_goods  会员收藏商品的记录列表，一条记录一个收藏商品
字段  类型  Null/默认     注释
rec_id  mediumint(8)    否   收藏记录的自增id
user_id     mediumint(8)    否   该条收藏记录的会员id，取值于users的user_id
goods_id    mediumint(8)    否   收藏的商品id，取值于goods的goods_id
add_time    int(11)     否   收藏时间
is_attention    tinyint(1)  否   是否关注该收藏商品;1是;0否

28.comment  用户对文章和产品的评论列表
字段  类型  Null/默认     注释
comment_id  int(10)     否   用户评论的自增id
comment_type    tinyint(3)      否 / 0   用户评论的类型;0评论的是商品,1评论的是文章
id_value    mediumint(8)    否 / 0   文章或者商品的id,文章对应的是article的article_id;商品对应的是goods的goods_id
email   varchar(60)     否   评论是提交的Email地址,默认取的user的email
user_name   varchar(60)     否   评论该文章或商品的人的名称,取值users的user_name
content     text    否   评论的内容
comment_rank    tinyint(1)      否 / 0   该文章或者商品的重星级;只有1到5星;由数字代替;其中5代表5星
add_time    int(10)     否 / 0   评论的时间
ip_address  varchar(15)     否 /     评论时的用户IP
status  tinyint(3)      否 / 0   是否被管理员批准显示;1是;0未批准显示
parent_id   int(10)     否 / 0   评论的父节点,取值该表的comment_id字段,如果该字段为0,则是一个普通评论,否则该条评论就是该字段的值所对应的评论的回复
user_id     int(10)     否 /0    发表该评论的用户的用户id,取值user的user_id

29.crons  计划任务插件安装配置信息
字段  类型  Null/默认     注释
cron_id     tinyint(3)      否   自增ID号
cron_code   varchar(20)     否   该插件文件在相应路径下的不包括''.php''部分的文件名，运行该插件将通过该字段的值寻找将运行的文件
cron_name   varchar(120)    否   计划任务的名称
cron_desc   text    是   计划人物的描述
cron_order  tinyint(3)      否   应该是用了设置计划任务执行的顺序的，即当同时触发2个任务时先执行哪一个，如果一样应该是id在前的先执行暂不确定
cron_config     text    否   对每次处理的数据的数量的值，类型，名称序列化；比如删几天的日志，每次执行几个商品或文章的处理
thistime    int(10)     否   该计划任务上次被执行的时间
nextime     int(10)     否   该计划任务下次被执行的时间
day     tinyint(2)  否   如果该字段有值，则计划任务将在每月的这一天执行该计划人物
week    varchar(1)  否   如果该字段有值，则计划任务将在每周的这一天执行该计划人物
hour    varchar(2)  否   如果该字段有值，则该计划任务将在每天的这个小时段执行该计划任务
minute  varchar(255)    否   如果该字段有值，则该计划任务将在每小时的这个分钟段执行该计划任务，该字段的值可以多个，用空格间隔
enable  tinyint(1)  否   该计划任务是否开启；0，关闭；1，开启
run_once    tinyint(1)  否   执行后是否关闭，这个关闭的意思还得再研究下
allow_ip    varchar(100)    否   允许运行该计划人物的服务器ip
alow_files  varchar(255)    否   运行触发该计划人物的文件列表可多个值，为空代表所有许可的

30.delivery_goods  
字段  类型  Null/默认     注释
Rec_id  mediumint(8)    否    
Delivery_id     mediumint(8)    否    
Goods_id    mediumint(8)    否    
Product_id  mediumint(8)    是    
Product_sn  Varchar(60)     是    
Goods_name  Varchar(120)    是    
Brand_name  Varchar(60)     是    
Goods_sn    Varchar(60)     是    
Is_real     Tinyint(1)  是    
Extension_code  Varchar(30)     是    
Parent_id   mediumint(8)    是    
Send_number     Smallint(5)     是    
Goods_attr  text    是    

31.delivery_order
字段  类型  Null/默认     注释
delivery_id     mediumint(8)    否    
delivery_sn     varchar(20)     否    
order_sn    varchar(20)     否    
order_id    mediumint(8)    否    
invoice_no  varchar(50)     是    
add_time    int(10)     是    
shipping_id     tinyint(3)  是    
shipping_name   varchar(120)    是    
user_id     mediumint(8)    是    
action_user     varchar(30)     是    
consignee   varchar(60)     是    
address     varchar(250)    是    
country     smallint(5)     是    
province    smallint(5)     是    
city    smallint(5)     是    
district    smallint(5)     是    
sign_building   varchar(120)    是    
email   varchar(60)     是    
zipcode     varchar(60)     是    
tel     varchar(60)     是    
mobile  varchar(60)     是    
best_time   varchar(120)    是    
postscript  varchar(255)    是    
how_oos     varchar(120)    是    
insure_fee  decimal(10,2)   是    
shipping_fee    decimal(10,2)   是    
update_time     int(10)     是    
suppliers_id    smallint(5)     是    
status  tinyint(1)      否    
agency_id   smallint(5)     是    

32.email_list  增加电子杂志订阅表
字段  类型  Null/默认     注释
id      mediumint(8)    否   邮件订阅的自增id
email   varchar(60)     否   邮件订阅所填的邮箱地址
stat    tinyint(1)  否   是否确认，可以用户确认也可以管理员确认；0，未确认；1，已确认
hash    varchar(10)     否   邮箱确认的验证码，系统生成后发送到用户邮箱，用户验证激活时通过该值判断是否合法；主要用来防止非法验证邮箱

33.email_sendlist  增加发送队列表
字段  类型  Null/默认     注释
id      mediumint(8)    否   id
email   varchar(100)    否   Email
template_id     mediumint(8)    否   模板ID
email_content   text    否   邮件内容
error   tinyint(1)  否   错误消息
pri     tinyint(10)     否   优先级
last_send   int(10)     否   最后发送时间

34.error_log  该表用来记录页面触发计划任务时失败所产生的错误
字段  类型  Null/默认     注释
id  int(10)     否   计划任务错误自增id
info    varchar(255)    否   错误详细信息
file    varchar(100)    否   产生错误的执行文件的绝对路径
time    int(10)     否   错误发生的时间

35.exchange_goods  
字段  类型  Null/默认     注释
Goods_id    Mediumint(8)    否    
Exchange_integral   Int(10)     否    
Is_exchange     Tinyint(1)  否    
Is_hot  Tinyint(1)  否    

36.favoutable_activity  优惠活动的配置信息（送礼、减免、打折）
字段  类型  Null/默认     注释
act_id  smallint(5)     否   优惠活动的自增id
act_name    varchar(255)    否   优惠活动的活动名称
start_time  int(10)     否   活动的开始时间
end_time    int(10)     否   活动的结束时间
user_rank   varchar(255)    否   可以参加活动的用户信息，取值于user_rank的rank_id；其中0是非会员，其他是相应的会员等级；多个值用逗号分隔', 
act_range   tinyint(3)      否   `act_range` tinyint(3) unsigned NOT NULL COMMENT '优惠范围；0，全部商品；1，按分类；2，按品牌；3，按商品
act_range_ext   varchar(255)    否   优惠范围；0，全部商品；1，按分类；2，按品牌；3，按商品
min_amount  decimal(10,2)   否   根据优惠活动范围的不同，该处意义不同；但是都是优惠范围的约束；如，如果是商品，该处是商品的id，如果是品牌，该处是品牌的id
max_amount  decimal(10,2)   否   订单达到金额下限，才参加活动
act_type    tinyint(3)      否   参加活动的订单金额下限，0，表示没有上限
act_type_ext    decimal(10,2)   否   参加活动的优惠方式；0，送赠品或优惠购买；1，现金减免；价格打折优惠
gift    text    否   如果是送赠品，该处是允许的最大数量，0，无数量限制；现今减免，则是减免金额，单位元；打折，是折扣值，100算，8折就是80
sort_order  tinyint(3)      否   如果有特惠商品，这里是序列化后的特惠商品的id,name,price信息;取值于goods的goods_id，goods_name，价格是添加活动时填写的

37.feedback  用户反馈信息表
字段  类型  Null/默认     注释
msg_id  mediumint(8)    否   反馈信息自增id
parent_id   mediumint(8)    否   父节点，取自该表msg_id；反馈该值为0；回复反馈为节点id
user_id     mediumint(8)    否   用户ID
user_name   varchar(60)     否   用户名
user_email  varchar(60)     否   Email
msg_title   varchar(200)    否   标题
msg_type    tinyint(1)      否   类型
Msg_status  tinyint(1)  否    
msg_content     text    否   内容
msg_time    int(10)     否   时间
message_img     varchar(255)    否   图片
order_id    int(11)     否   是否回复
Msg_area    tinyint(1)  否   

38.friend_link  友情链接配置信息表
字段  类型  Null/默认     注释
link_id     smallint(5)     否   友情链接自增id
link_name   varchar(255)    否   友情链接的名称，img的alt的内容
link_url    varchar(255)    否   友情链接网站的链接地址
link_logo   varchar(255)    否   友情链接的logo
show_order  tinyint(3)      否   在页面的显示顺序

39.goods  商品表
字段  类型  Null/默认     注释
goods_id    mediumint(8)    否   商品id
cat_id      smallint(5)     否   商品所属商品分类id，取值category的cat_id
goods_sn    varchar(60)     否   商品的唯一货号
goods_name      varchar(120)    否   商品的名称
goods_name_style    varchar(60)     否   商品名称显示的样式；包括颜色和字体样式；格式如#ff00ff+strong
click_count     int(10)     否   商品点击数
brand_id    smallint(5)     否   品牌id，取值于brand 的brand_id
provider_name   varchar(100)    否   供货人的名称，程序还没实现该功能
goods_number    smallint(5)     否   商品库存数量
goods_weight    decimal(10,3)   否   商品的重量，以千克为单位
market_price    decimal(10,2)   否   市场售价
shop_price      decimal(10,2)   否   本店售价
promote_price   decimal(10,2)   否   促销价格
promote_start_date      int(11)     否   促销价格开始日期
promote_end_date    int(11)     否   促销价格结束日期
warn_number     tinyint(3)      否   商品报警数量
keywords    varchar(255)    否   商品关键字，放在商品页的关键字中，为搜索引擎收录用
goods_brief     varchar(255)    否   商品的简短描述
goods_desc      text    否   商品的详细描述
goods_thumb     varchar(255)    否   商品在前台显示的微缩图片，如在分类筛选时显示的小图片
goods_img   varchar(255)    否   商品的实际大小图片，如进入该商品页时介绍商品属性所显示的大图片
original_img    varchar(255)    否   应该是上传的商品的原始图片
is_real     tinyint(3)      否   是否是实物，1，是；0，否；比如虚拟卡就为0，不是实物
extension_code      varchar(30)     否   商品的扩展属性，比如像虚拟卡
is_on_sale      tinyint(1)      否   该商品是否开放销售，1，是；0，否
is_alone_sale   tinyint(1)      否   是否能单独销售，1，是；0，否；如果不能单独销售，则只能作为某商品的配件或者赠品销售
Is_shipping     tinyint(1)  否    
integral    int(10)     否   购买该商品可以使用的积分数量，估计应该是用积分代替金额消费；但程序好像还没有实现该功能
add_time    int(10)     否   商品的添加时间
sort_order      smallint(4)     否   应该是商品的显示顺序，不过该版程序中没实现该功能
is_delete   tinyint(1)      否   商品是否已经删除，0，否；1，已删除
is_best     tinyint(1)      否   是否是精品；0，否；1，是
is_new      tinyint(1)      否   是否是新品
is_hot      tinyint(1)      否   是否热销，0，否；1，是
is_promote      tinyint(1)      否   是否特价促销；0，否；1，是
bonus_type_id   tinyint(3)      否   购买该商品所能领到的红包类型
last_update     int(10)     否   最近一次更新商品配置的时间
goods_type      smallint(5)     否   商品所属类型id，取值表goods_type的cat_id
seller_note     varchar(255)    否   商品的商家备注，仅商家可见
give_integral   int(11)     否   购买该商品时每笔成功交易赠送的积分数量
rank_integral   int(11)     否    
suppliers_id    smallint(5)     是    
is_check    tinyint(1)      是    

40.goods_activity  拍卖活动和夺宝奇兵活动配置信息
字段  类型  Null/默认     注释
act_id  mediumint(8)    否   处境id号
act_name    varchar(255)    否   促销活动的名称
act_desc    text    否   促销活动的描述
act_type    tinyint(3)      否    
goods_id    mediumint(8)    否   参加活动的id，取值于goods的goods_id
product_id  mediumint(8)         
goods_name  varchar(255)    否   商品的名称，取值于goods的goods_id
start_time  int(10)     否   活动开始时间
end_time    int(10)     否   活动开始结束时间
is_finished     tinyint(3)      否   活动是否结束，0，结束；1，未结束

41.goods_article  文章关联产品表
字段  类型  Null/默认     注释
goods_id    mediumint(8)    否 / 0   商品id，取自goods的goods_id
article_id  mediumint(8)    否 / 0   文章id，取自 article 的article_id
admin_id    tinyint(3)  否 / 0   猜想是管理员的id，但是程序中似乎没有提及到

42.good_attr  具体商品属性表
字段  类型  Null/默认     注释
goods_attr_id   int(10)     否   自增ID号
goods_id    mediumint(8)    否   该具体属性属于的商品，取值于goods的goods_id
attr_id     smallint(5)     否   该具体属性属于的属性类型的id，取自attribute 的attr_id
attr_value      text    否   该具体属性的值
attr_pric   varchar(255)    否   该属性对应在商品原价格上要加的价格

43.goods_cat  商品的拓展分类
字段  类型  Null/默认     注释
goods_id    mediumint(8)    否   商品id
cat_id  smallint(5)     否   商品分类id

44.goods_gallery  商品相册表
字段  类型  Null/默认     注释
img_id  mediumint(8)    否   商品相册ID
goods_id    mediumint(8)    否   图片属性商品的id
img_url     varchar(255)    否   实际图片url
img_desc    varchar(255)    否   图片说明信息
thumb_url   varchar(255)    否   微缩图片url
img_original    varchar(255)    否   根据名字猜，应该是上传的图片文件的最原始的文件的url

45.goods_type  商品类型
字段  类型  Null/默认     注释
cat_id      smallint(5)     否   自增id
cat_name    varchar(60)     否   商品类型名
enabled     tinyint(1)      否   类型状态1，为可用；0为不可用；不可用的类型，在添加商品的时候选择商品属性将不可选
attr_group  varchar(255)    否   商品属性分组，将一个商品类型的属性分成组，在显示的时候也是按组显示。该字段的值显示在属性的前一行，像标题的作用

46.group_goods  商品配件配置表
字段  类型  Null/默认     注释
parent_id   mediumint(8)    否   父商品id
goods_id    mediumint(8)    否   配件商品id
goods_price     decimal(10,2)   否   配件商品的价格
admin_id    tinyint(3)  否   添加该配件的管理员id

47.keywords  页面搜索关键字搜索记录
字段  类型  Null/默认     注释
date    date    否   搜索日期
searchengine    varchar(20)     否   搜索引擎，默认是ecshop
keyword     varchar(90)     否   搜索关键字，即用户填写的搜索内容
count   mediumint(8)    否   搜索次数，按天累加

48.link_goods  关联商品信息表
字段  类型  Null/默认     注释
goods_id    mediumint(8)    否   商品id
link_goods_id   mediumint(8)    否   被关联的商品的id
is_double   tinyint(1)      否   是否是双向关联; 0否; 1是
admin_id    tinyint(3)  否   添加此关联商品信息的管理员id

49.mail_templates  各种邮件的模板配置模板
字段  类型  Null/默认     注释
template_id     tinyint(1)      否   邮件模板自增id
template_code   varchar(30)     否   模板字符串名称，主要用于插件言语包时匹配语言包文件等用途
is_html     tinyint(1)      否   邮件是否是html格式；0，否；1，是
template_subject    varchar(200)    否   该邮件模板的邮件主题
template_content    text    否   邮件模板的内容
last_modify     int(10)     否   最后一次修改模板的时间
last_send   int(10)     否   最近一次发送的时间，好像仅在杂志才记录
type    varchar(10)     否   该邮件模板的邮件类型；共2个类型；magazine，杂志订阅；template，关注订阅

50.member_price 
字段  类型  Null/默认     注释
price_id    mediumint(8)    否   折扣价自增id
goods_id    mediumint(8)    否   商品的id
user_rank   tinyint(3)  否   会员登记id
user_price  decimal(10,2)   否   指定商品对指定会员等级的固定定价价格，单位元

51.nav  上中下3个导航栏的显示配置
字段  类型  Null/默认     注释
id  mediumint(8)    否   导航配置自增id
ctype   varchar(10)     是    
cid     smallint(5)     是    
name    varchar(255)    否   导航显示标题
ifshow  tinyint(1)  否   是否显示
vieworder   tinyint(1)  否   页面显示顺序，数字越大越靠后
opennew     tinyint(1)  否   导航链接页面是否在新窗口打开，1，是；其他，否
url     varchar(255)    否   链接的页面地址
type    varchar(10)     否   处于导航栏的位置，top为顶部；middle为中间；bottom,为底部

52.order_action  对订单操作日志表
字段  类型  Null/默认     注释
action_id   mediumint(8)    否   流水号
order_id    mediumint(8)    否   被操作的交易号
action_user     varchar(30)     否   操作该次的人员
order_status    tinyint(1)      否   作何操作0,未确认, 1已确认; 2已取消; 3无效; 4退货
shipping_status     tinyint(1)      否   发货状态; 0未发货; 1已发货  2已取消  3备货中
pay_status  tinyint(1)      否   支付状态 0未付款;  1已付款中;  2已付款
action_note     varchar(255)    否   操作血注
log_time    int(11)     否   操作时间

53.order_goods  订单的商品信息
字段  类型  Null/默认     注释
rec_id      mediumint(8)    否   订单商品信息自增id
order_id    mediumint(8)    否   订单商品信息对应的详细信息id，取值order_info的order_id
goods_id    mediumint(8)    否   商品的的id，取值表goods 的goods_id
goods_name      varchar(120)    否   商品的名称，取值表goods
goods_sn    varchar(60)     否   商品的唯一货号，取值goods
product_id  mediumint(8)    否    
goods_number    smallint(5)     否   商品的购买数量
market_price    decimal(10,2)   否   商品的市场售价，取值goods
goods_price     decimal(10,2)   否   商品的本店售价，取值goods
goods_attr      text    否   购买该商品时所选择的属性
send_number     smallint(5)     否   当不是实物时，是否已发货，0，否；1，是
is_real     tinyint(1)      否   是否是实物，0，否；1，是；取值goods
extension_code      varchar(30)     否   商品的扩展属性，比如像虚拟卡。取值goods
parent_id   mediumint(8)    否   父商品id，取值于cart的parent_id；如果有该值则是值多代表的物品的配件
is_gift     smallint(5)     否   是否参加优惠活动，0，否；其他，取值于cart 的is_gift，跟其一样，是参加的优惠活动的id
goods_attr_id   varchar(255)    否   

54.order_info  订单的配送
字段  类型  Null/默认     注释
order_id    mediumint(8)    否   自增ID
order_sn    varchar(20)     否    订单号,唯一
user_id     mediumint(8)    否   用户id,同users的user_id
order_status    tinyint(1)      否   订单的状态;0未确认,1确认,2已取消,3无效,4退货
shipping_status     tinyint(1)      否   商品配送情况;0未发货,1已发货,2已收货,4退货
pay_status      tinyint(1)      否   支付状态;0未付款;1付款中;2已付款
consignee   varchar(60)     否   收货人的姓名,用户页面填写,默认取值表user_address
country     smallint(5)     否   收货人的国家,用户页面填写,默认取值于表user_address,其id对应的值在region
province    smallint(5)     否   收货人的省份,用户页面填写,默认取值于表user_address, 其id对应的值在region
city    smallint(5)     否   收货人的城市,用户页面填写,默认取值于表user_address,其id对应的值在region
district    smallint(5)     否   收货人的地区,用户页面填写,默认取值于表user_address,其id对应的值在region
address     varchar(255)    否   收货人的详细地址,用户页面填写,默认取值于表user_address
zipcode     varchar(60)     否   收货人的邮编,用户页面填写,默认取值于表user_address
tel     varchar(60)     否   收货人的电话,用户页面填写,默认取值于表user_address
mobile      varchar(60)     否   收货人的手机,用户页面填写,默认取值于表user_address
email   varchar(60)     否   收货人的Email, 用户页面填写,默认取值于表user_address
best_time   varchar(120)    否   收货人的最佳送货时间,用户页面填写,默认取值于表user_addr 
sign_building   varchar(120)    否   送货人的地址的标志性建筑,用户页面填写,默认取值于表user_address
postscript      varchar(255)    否   订单附言,由用户提交订单前填写
shipping_id     tinyint(3)  否   用户选择的配送方式id,取值表shipping
shipping_name   varchar(120)    否   用户选择的配送方式的名称,取值表shipping
pay_id      tinyint(3)  否   用户选择的支付方式的id,取值表payment
pay_name    varchar(120)    否   用户选择的支付方式名称,取值表payment
how_oos     varchar(120)    否   缺货处理方式,等待所有商品备齐后再发,取消订单;与店主协商
how_surplus     varchar(120)    否   根据字段猜测应该是余额处理方式,程序未作这部分实现
pack_name   varchar(120)    否   包装名称,取值表pack
card_name   varchar(120)    否   贺卡的名称,取值card
card_message    varchar(255)    否   贺卡内容,由用户提交
inv_payee   varchar(120)    否   发票抬头,用户页面填写
inv_content     varchar(120)    否   发票内容,用户页面选择,取值shop_config的code字段的值 为invoice_content的value
goods_amount    decimal(10,2)   否   商品的总金额
shipping_fee    decimal(10,2)   否   配送费用
insure_fee      decimal(10,2)   否   保价费用
pay_fee     decimal(10,2)   否   支付费用,跟支付方式的配置相关,取值表payment
pack_fee    decimal(10,2)   否   包装费用,取值表pack
card_fee    decimal(10,2)   否   贺卡费用,取值card
money_paid      decimal(10,2)   否   已付款金额
surplus     decimal(10,2)   否   该订单使用金额的数量,取用户设定余额,用户可用余额,订单金额中最小者
integral    int(10)     否   使用的积分的数量,取用户使用积分,商品可用积分,用户拥有积分中最小者
integral_money      decimal(10,2)   否   使用积分金额
bonus   decimal(10,2)   否   使用红包金额
order_amount    decimal(10,2)   否   应付款金额
from_ad     smallint(5)     否   订单由某广告带来的广告id,应该取值于ad
referer     varchar(255)    否   订单的来源页面
add_time    int(10)     否   订单生成时间
confirm_time    int(10)     否   订单确认时间
pay_time    int(10)     否   订单支付时间
shipping_time   int(10)     否   订单配送时间
pack_id     tinyint(3)      否   包装id,取值表pck
card_id     tinyint(3)      否   贺卡id,用户在页面选择,取值
bonus_id    smallint(5)     否   红包id, user_bonus的bonus_id
invoice_no      varchar(50)     否   发货时填写, 可在订单查询查看
extension_code      varchar(30)     否   通过活动购买的商品的代号,group_buy是团购; auction是拍卖;snatch夺宝奇兵;正常普通产品该处理为空
extension_id    mediumint(8)    否   通过活动购买的物品id,取值ecs_good_activity;如果是正常普通商品,该处为0
to_buyer    varchar(255)    否   商家给客户的留言,当该字段值时可以在订单查询看到
pay_note    varchar(255)    否   付款备注, 在订单管理编辑修改
agency_id   smallint(5)     否   该笔订单被指派给的办事处的id, 根据订单内容和办事处负责范围自动决定,也可以有管理员修改,取值于表agency
inv_type    varchar(60)     否   发票类型,用户页面选择,取值shop_config的code字段的值invoice_type的value
tax     decimal(10,2)   否   发票税额
is_separate     tinyint(1)  否   0未分成或等待分成;1已分成;2取消分成
parent_id   mediumint(8)    否   自增ID
discount    decimal(10,2)   否    订单号,唯一

55.pack  商品包装信息配置表
字段  类型  Null/默认     注释
pack_id     tinyint(3)      否   包装配置的自增id
pack_name   varchar(120)    否   包装的名称
pack_img    varchar(255)    否   包装图纸
pack_fee    smallint(5)     否   包装的费用
free_money      smallint(5)     否   订单达到此金额可以免除该包装费用
pack_desc   varchar(255)    否   包装描述

56.package_goods 
字段  类型  Null/默认     注释
Package_id  mediumint(8)    否    
Goods_id    mediumint(8)    否    
Product_id  mediumint(8)    否    
Goods_number    Smallint(5)     否    
Admin_id    Tinyint(3)  否    

57.payment  安装的支付方式配置信息
字段  类型  Null/默认     注释
pay_id      tinyint(3)      否   已安装的支付方式自增id
pay_code    varchar(20)     否   支付方式 的英文缩写,其实是该支付方式处理插件的不带后缀的文件名部分
pay_name    varchar(120)    否   支付方式名称
pay_fee     varchar(10)     否   支付费用
pay_desc    text    否   支付方式描述
pay_order   tinyint(3)      否   支付方式在页面的显示顺序
pay_config      text    否   支付方式的配置信息,包括商户号和密钥什么的
enabled     tinyint(1)      否   是否可用;0否;1是
is_cod      tinyint(1)      否   是否货到付款, 0否;1是
is_online   tinyint(1)      否   是否在线支付;0否;1是

58.pay_log  系统支付记录
字段  类型  Null/默认     注释
log_id      int(10)     否   支付记录自增id
order_id    mediumint(8)    否   对应的交交易记录的id,取值表order_info
order_amount    decimal(10,2)   否   支付金额
order_type      tinyint(1)      否   支付类型,0订单支付,1会员预付款支付
is_paid     tinyint(1)      否   是否已支付,0否;1是

59.plugins  
字段  类型  Null/默认     注释
code    varchar(30)     否    
version     varchar(10)     否    
library     varchar(255)    否    
assign      tinyint(1)      否    
install_date    int(10)     否    

60.products  
字段  类型  Null/默认     注释
Product_id  mediumint(8)    否    
Goods_id    mediumint(8)    否    
Goods_attr  varchar(50)     是    
Product_sn  varchar(50)     是    
Product_number  smallint(5)     是   

61.region  地区列表
字段  类型  Null/默认     注释
region_id   smallint(5)     否   表示该地区的id
parent_id   smallint(5)     否   该地区的上一个节点的地区id
region_name     varchar(120)    否   地区的名字
region_type     tinyint(1)  否   该地区的下一个节点的地区id
agency_id   smallint(5)     否   办事处的id,这里有一个bug,同一个省不能有多个办事处,该字段只记录最新的那个办事处的id

62.reg_extend_info  
字段  类型  Null/默认     注释
Id  Int(10)     否    
User_id     Mediumint(8)    否    
Reg_field_id    Int(10)     否    
Content     text    否    

63.reg_fields  
字段  类型  Null/默认     注释
Id  tinyint(3)  否    
Reg_field_name  varchar(60)     否    
Dis_order   tinyint(3)  否    
Display     tinyint(1)  否    
Type    tinyint(1)  否    
Is_need     tinyint(1)  否    

64.role  
字段  类型  Null/默认     注释
Role_id     Smallint(5)     否    
Role_name   Varchar(60)     否    
Action_list     Text    否    
Role_describe   text    是    

65.searchengine  搜索引擎访问记录
字段  类型  Null/默认     注释
date    date    否   搜索引擎访问日期
searchengine    varchar(20)     否   搜索引擎名称
count   mediumint(8)    否   访问次数

66.sessions  session记录表
字段  类型  Null/默认     注释
sesskey     char(32)    否   sessionid
expiry      int(10)     否   Session创建时间
userid      mediumint(8)    否   如果不是管理员，记录用户id
adminid     mediumint(8)    否   如果是管理员记录管理员id
ip      char(15)    否   客户端ip
user_name   varchar(60)     否    
user_rank   tinyint(3)  否    
discount    decimal(3,2)    否    
email   varchar(60)     否    
data    char(255)   否   序列化后的session数据，如果session数据大于255则将数据存到表sessions_data，此处为空

67.sessions_data  session数据库
字段  类型  Null/默认     注释
sesskey     varchar(32)     否   sessionid
expiry      int(10)     否   Session创建时间
data    longtext    否   Session序列化后的数据

68.shipping  配送方式配置信息表
字段  类型  Null/默认     注释
shipping_id     tinyint(3)      否   自增id号
shipping_code   varchar(20)     否   配送方式的字符串代号
shipping_name   varchar(120)    否   配送方式名称
shipping_desc   varchar(255)    否   配送方式描述
insure      varchar(10)     否   保价费用，单位元，或者是百分数，该值直接输出为报价费用
support_cod     tinyint(1)      否   是否支持货到付款，1，支持；0，不支持
enabled     tinyint(1)      否   该配送方式是否被禁用，1，可用；0，禁用
shipping_print      否    
print_bg        是    
config_lable        是    
print_model         是    

69.shipping_area  配送方式所属的配送区域和配送费用信息
字段  类型  Null/默认     注释
shipping_area_id    smallint(5)     否   自增id号
shipping_area_name      varchar(150)    否   配送方式中的配送区域的名字
shipping_id     tinyint(3)      否   该配送区域所属的配送方式，同shipping的shipping_id
configure   text    否   序列化的该配送区域的费用配置信息

70.shop_config  全站配置信息表
字段  类型  Null/默认     注释
id      smallint(5)     否   全站配置信息自增id
parent_id   smallint(5)     否   父节点id，取值于该表id字段的值
code    varchar(30)     否   跟变量名的作用差不多，其实就是语言包中的字符串索引，如$_LANG[''cfg_range''][''cart_confirm'']
type    varchar(10)     否   该配置的类型，text，文本输入框
store_range     varchar(255)    否   当语言包中的code字段对应的是一个数组时，那该处就是该数组的索引，如$_LANG[''cfg_range''][''cart_confirm''][1]；只有type字段为select,options时才有值
store_dir   varchar(255)    否   当type为file时才有值，文件上传后的保存目录
value   text    否   该项配置的值
sort_order      tinyint(3)      否   显示顺序，数字越大越靠后

71.snatch_log  夺宝奇兵出价记录表
字段  类型  Null/默认     注释
log_id      mediumint(8)    否   自增id号
snatch_id   tinyint(3)      否   夺宝奇兵活动号，取值于goods_activity的act_id字段
user_id     mediumint(8)    否   出价的用户id，取值于users的user_id
bid_price   decimal(10,2)   否   出价的价格
bid_time    int(10)     否   出价的时间

72.stats  访问信息记录表
字段  类型  Null/默认     注释
access_time     int(10)     否   访问时间
ip_address      varchar(15)     否   访问者ip
visit_times     smallint(5)     否   访问次数，如果之前有过访问次数，在以前的基础上＋1
browser     varchar(60)     否   浏览器及版本
system      varchar(20)     否   操作系统
language    varchar(20)     否   语言
area    varchar(30)     否   Ip所在地区
referer_domain      varchar(100)    否   页面访问来源域名
referer_path    varchar(200)    否   页面访问来源除域名外的路径部分
access_url      varchar(255)    否   访问页面文件名

73.suppliers  
字段  类型  Null/默认     注释
suppliers_id    smallint(5)     否    
suppliers_name  varchar(255)    是    
suppliers_desc  mediumtext  是    
is_check    tinyint(1)  否    

74.tag  商品的标记
字段  类型  Null/默认     注释
tag_id      mediumint(8)    否   商品标签自增id
user_id     mediumint(8)    否   用户的id
goods_id    mediumint(8)    否   商品的id
tag_words   varchar(255)    否   标签内容

75.template  模板设置数据表
字段  类型  Null/默认     注释
filename    varchar(30)     否   该条模板配置属于哪个模板页面
region      varchar(40)     否   该条模板配置在它所属的模板文件中的位置
library     varchar(40)     否   该条模板配置在它所属的模板文件中的位置处应该引入的lib的相对目录地址
sort_order      tinyint(1)      否   模板文件中这个位置的引入lib项的值的显示顺序
id      smallint(5)     否   字段意义待查
number      tinyint(1)      否   每次显示多少个值
type    tinyint(1)      否   属于哪个动态项，0，固定项；1，分类下的商品；2，品牌下的商品；3，文章列表；4，广告位
theme   varchar(60)     否   该模板配置项属于哪套模板的模板名
remarks     varchar(30)     否   备注，可能是预留字段，没有值所以没确定用途

76.topic  专题活动配置表
字段  类型  Null/默认     注释
topic_id    int(10)     否   专题自增id
title   varchar(255)    否   专题名称
intro   text    否   专题介绍
start_time      int(11)     否   专题开始时间
end_time    int(10)     否   结束时间
data    text    否   专题数据内容，包括分类，商品等
template    varchar(255)    否   专题模板文件
css     text    否   专题样式代码
topic_img   varchar(255)    是    
title_pic   varchar(255)    是    
base_style  char(6)     是    
htmls   mediumtext  是    
keywords    varchar(255)    是    
description     varchar(255)    是    

77.users  
字段  类型  Null/默认     注释
user_id     mediumint(8)    否   会员资料自增id
email   varchar(60)     否   会员Email
user_name   varchar(60)     否   用户名
password    varchar(32)     否   用户密码
question    varchar(255)    否   密码提问
answer      varchar(255)    否   密码回答
sex     tinyint(1)      否   性别 ;  0保密;  1男; 2女
birthday    date    否   出生日期
user_money      decimal(10,2)   否   用户现有资金
frozen_money    decimal(10,2)   否   用户冻结资金
pay_points      int(10)     否   消费积分
rank_points     int(10)     否   会员等级积分
address_id      mediumint(8)    否   收货信息id,表值表user_address
reg_time    int(10)     否   注册时间 
last_login      int(11)     否   最后一次登录时间
last_time   datetime    否   应该是最后一次修改信息时间，该表信息从其他表同步过来考虑
last_ip     varchar(15)     否   最后一次登录IP
visit_count     smallint(5)     否   员登记id，取值user_rank
user_rank   tinyint(3)      否   会员登记id，取值user_rank
is_special      tinyint(3)      否   是否特殊
salt    varchar(10)     否    
parent_id   mediumint(9)    否   推荐人会员id
flag    tinyint(3)      否   标识
alias   varchar(60)     否   昵称
msn     varchar(60)     否   msn账号
qq      varchar(20)     否   Qq账号
office_phone    varchar(20)     否   办公电话
home_phone      varchar(20)     否   家用电话
mobile_phone    varchar(20)     否   移动电话
is_validated    tinyint(3)      否   是否生效
credit_line     decimal(10,2)   否   最大消费
passwd_question     varchar(50)     是    
passwd_answer   varchar(255)    是   

78.user_account  用户资金流动表
字段  类型  Null/默认     注释
id      mediumint(8)    否   自增id号
user_id     mediumint(8)    否   用户登录后保存在session中的id号，跟users表中的user_id对应
admin_user      varchar(255)    否   操作该笔交易的管理员的用户名
amount      decimal(10,2)   否   资金的数目，正数为增加，负数为减少
add_time    int(10)     否   记录插入时间
paid_time   int(10)     否   记录更新时间
admin_note      varchar(255)    否   管理员的被准
user_note   varchar(255)    否   用户备注
process_type    tinyint(1)  否   操作类型，1，退款；0，预付费，其实就是充值
payment     varchar(90)     否   支付渠道的名称，取自payment的pay_name字段
is_paid     tinyint(1)  否   是否已经付款，０，未付；１，已付

79.user_address  收货人的信息列表
字段  类型  Null/默认     注释
address_id      mediumint(8)    否    
address_name    varchar(50)     否   名称
user_id     mediumint(8)    否   用户表中的流水号
consignee   varchar(60)     否   收货人的名字
email   varchar(60)     否   收货人的email
country     smallint(5)     否   收货人的国家
province    smallint(5)     否   收货人的省份
city    smallint(5)     否   收货人城市
district    smallint(5)     否   收货人的地区
address     varchar(120)    否   收货人的详细地址
zipcode     varchar(60)     否   收货人的邮编
tel     varchar(60)     否   收货人的电话
mobile      varchar(60)     否   收货人的手机号
sign_building   varchar(120)    否   收货地址的标志性建筑名
best_time   varchar(120)    否   收货人的最佳收货时间

80.user_bonus  已经发送的红包信息列表
字段  类型  Null/默认     注释
bonus_id    mediumint(8)    否   红包的流水号
bonus_type_id   tinyint(3)      否   红包发送类型.0,按用户如会员等级,会员名称发放;1,按商品类别发送;2,按订单金额所达到的额度发送;3,线下发送
bonus_sn    bigint(20)      否   红包号,如果为0就是没有红包号.如果大于0,就需要输入该红包号才能使用红包
user_id     mediumint(8)    否   该红包属于某会员的id.如果为0,就是该红包不属于某会员
used_time   int(10)     否   红包使用的时间
order_id    mediumint(8)    否   使用了该红包的交易号
emailed     tinyint(3)      否   否已经将红包发送到用户的邮箱；1，是；0，否

81.user_feed  
字段  类型  Null/默认     注释
Feed_id     mediumint(8)    否    
User_id     mediumint(8)    否    
Value_id    mediumint(8)    否    
Goods_id    mediumint(8)    否    
Feed_type   tinyint(1)  否    
Is_feed     tinyint(1)  否    

82.user_rank  会员等级配置信息
字段  类型  Null/默认     注释
rank_id     tinyint(3)      否   会员等级编号，其中0是非会员
rank_name   varchar(30)     否   会员等级名称
min_points      int(10)     否   该等级的最低积分
max_points      int(10)     否   该等级的最高积分
discount    tinyint(3)      否   该会员等级的商品折扣
show_price      tinyint(1)      否   是否在不是该等级会员购买页面显示该会员等级的折扣价格.1,显示;0,不显示
special_rank    tinyint(1)      否   是否事特殊会员等级组.0,不是;1,是

83.virtual_card  虚拟卡卡号库
字段  类型  Null/默认     注释
card_id     mediumint(8)    否   虚拟卡卡号自增id
goods_id    mediumint(8)    否   该虚拟卡对应的商品id，取值于表goods
card_sn     varchar(60)     否   加密后的卡号
card_password   varchar(60)     否   加密后的密码
add_date    int(11)     否   卡号添加日期
end_date    int(11)     否   卡号截至使用日期
is_saled    tinyint(1)  否   是否卖出，0，否；1，是
order_sn    varchar(20)     否   卖出该卡号的交易号，取值表order_info
crc32   int(11)     否   crc32后的key

84.volume_price  
字段  类型  Null/默认     注释
Price_type  Tinyint(1)  否    
Goods_id    Mediumint(8)    否    
Volume_number   Smallint(5)     否    
Volume_price    Decimal(10,2)   否    

85.vote  网站调查信息记录表
字段  类型  Null/默认     注释
vote_id     smallint(5)     否   在线调查自增id
vote_name   varchar(250)    否   在线调查主题
start_time      int(11)     否   在线调查开始时间
end_time    int(11)     否   在线调查结束时间
can_multi   tinyint(1)      否   能否多选，0，可以；1，不可以
vote_count      int(10)     否   投票人数也可以说投票次数

86.vote_log  投票记录表
字段  类型  Null/默认     注释
log_id      mediumint(8)    否   投票记录自增id
vote_id     smallint(5)     否   关联的投票主题id，取值表vote
ip_address      varchar(15)     否   投票的ip地址
vote_time   int(10)     否   投票的时间

87.vote_option  投票的选项内容表
字段  类型  Null/默认     注释
option_id   smallint(5)     否   投票选项自增id
vote_id     smallint(5)     否   关联的投票主题id，取值表vote
option_name     varchar(250)    否   投票选项的值
option_count    int(8)  否   该选项的票数
option_order    tinyint(3)  否    

88.wholesale  批发方案表
字段  类型  Null/默认     注释
act_id      mediumint(8)    否   批发方案自增id
goods_id    mediumint(8)    否   商品ID
goods_name      varchar(255)    否   商品名称
rank_ids    varchar(255)    否   适用会员登记,多个值之间用逗号分隔取值于user_rank
prices      text    否   序列化后的商品属性,数量,价格
enabled     tinyint(3)      否   批发方案是否可用 