create table love(
id int primary key auto_increment,
ta varchar(6) not null comment '被表白名',
i varchar(6) not null comment '表白名',
love varchar(255) not null comment '表白内容',
time int not null comment '表白时间'
)charset utf8;

create table sakura(
id int primary key auto_increment,
tplj varchar(255) not null comment '图片链接',
name varchar(6) not null comment '日常人名',
sakura varchar(255) not null comment '日常内容',
time int not null comment '发布时间'
)charset utf8;

create table root(
id int primary key auto_increment,
root text not null comment '扩列内容',
time int not null comment '发布时间'
)charset utf8;

create table love_ip(
id int primary key auto_increment,
name varchar(6) not null comment '记录昵称',
ip varchar(16) not null comment 'IP地址',
time int not null comment '记录时间'
)charset utf8;

create table yingzhenyu(
wzbt varchar(10) not null comment '网站标题',
wztb varchar(255) not null comment '网站图标',
zzqq varchar(10) not null comment '站长QQ',
zznc varchar(10) not null comment '站长昵称',
bjyy varchar(255) not null comment '背景音乐',
sytp varchar(255) not null comment '首页图片',
sttz varchar(255) not null comment '首图跳转',
sytz varchar(255) not null comment '首页通知'
)charset utf8;


INSERT INTO yingzhenyu(wzbt,wztb,zzqq,zznc,bjyy,sytp,sttz,sytz) VALUES ("梦溪中学表白墙","http://sakura.gold/img/sakura.png","3381229330","TTS","http://sakura.gold/img/sakura.mp3
","http://sakura.gold/img/sakura.png","http://www.sakura.gold/","这里是梦溪中学表白墙，欢迎您来表白！");


create table admin(
nc varchar(255) not null comment '管理员昵称',
mm varchar(255) not null comment '管理员密码'
)charset utf8;

-- 点赞表
create table love_like(
id int primary key auto_increment,
love_id int not null comment '表白ID',
ip varchar(16) not null comment '用户IP',
time int not null comment '点赞时间',
key idx_love_id (love_id),
key idx_ip (ip)
)charset utf8;

-- 评论表
create table love_comment(
id int primary key auto_increment,
love_id int not null comment '表白ID',
content varchar(255) not null comment '评论内容',
ip varchar(16) not null comment '用户IP',
time int not null comment '评论时间',
username varchar(20) not null default '匿名' comment '用户名',
key idx_love_id (love_id)
)charset utf8;

INSERT INTO admin(nc,mm) VALUES ('admin','123456');