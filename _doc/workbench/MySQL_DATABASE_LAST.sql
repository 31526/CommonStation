SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `mytest` ;
CREATE SCHEMA IF NOT EXISTS `mytest` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mytest` ;

-- -----------------------------------------------------
-- Table `mytest`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`user` ;

CREATE TABLE IF NOT EXISTS `mytest`.`user` (
  `uid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键UID',
  `nickname` CHAR(20) NOT NULL DEFAULT '' COMMENT '用户昵称',
  `email` VARCHAR(50) NOT NULL DEFAULT '',
  `mobile` CHAR(11) NOT NULL DEFAULT '',
  `password` CHAR(32) NOT NULL DEFAULT '' COMMENT '密码，md5',
  `login_num` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户登录次数',
  `gold_num` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户拥有的金币数量',
  `credit_num` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户积分，通过日常操作可以增加积分',
  `active` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0未激活 1激活邮箱 2激活手机 3邮箱手机全激活 4通过实名认证',
  `level` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户等级根据积分走的',
  `lock` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0,未锁定，1锁定',
  `robot` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否为机器人用户，0为否，1为1，机器人用户为系统添加注册的',
  `gender` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '性别',
  `truename` CHAR(10) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `birthday` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '生日 Birthday 出生年月日以int格式存储的时间戳',
  `birth_year` SMALLINT(4) UNSIGNED NOT NULL DEFAULT 0 COMMENT '出生年份',
  `birth_month` TINYINT(2) UNSIGNED NOT NULL DEFAULT 0 COMMENT '出生月份',
  `birth_day` TINYINT(2) UNSIGNED NOT NULL DEFAULT 0 COMMENT '出生的日期',
  `register_ip` CHAR(15) NOT NULL DEFAULT '' COMMENT '注册IP地址',
  `register_time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '注册日期',
  `register_address` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '注册地址',
  `last_login_ip` CHAR(15) NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `last_login_time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后登录时间',
  `last_login_address` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '最后登录地址',
  `fans_num` SMALLINT(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '粉丝数量',
  `follow_num` SMALLINT(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '跟随了多少个人',
  `slogan` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '个人标语slogan',
  `introduce` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '自我介绍',
  `star_num` TINYINT(2) UNSIGNED NOT NULL DEFAULT 0 COMMENT '12星座，12个数字代表不同的星座',
  `publish_num` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发布的文章数量',
  `comment_num` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '评论数量',
  `praise_num` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '被点赞的次数',
  `view_num` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`uid`),
  INDEX `nickname` (`nickname` ASC),
  INDEX `mobile` (`mobile` ASC),
  INDEX `email` (`email` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '用户数据表';


-- -----------------------------------------------------
-- Table `mytest`.`user_login_log`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`user_login_log` ;

CREATE TABLE IF NOT EXISTS `mytest`.`user_login_log` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键自增',
  `uid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户uid',
  `nickname` CHAR(20) NOT NULL DEFAULT '' COMMENT '用户昵称',
  `time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户登录退出日志时间',
  `login_ip` CHAR(15) NOT NULL DEFAULT '' COMMENT '登录ip地址',
  `begin_ip` CHAR(15) NOT NULL DEFAULT '' COMMENT '开始ip段',
  `end_ip` CHAR(15) NOT NULL DEFAULT '',
  `country` VARCHAR(50) NOT NULL DEFAULT '',
  `area` VARCHAR(50) NOT NULL DEFAULT '',
  `exit` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否为退出操作1=退出 0=登录',
  PRIMARY KEY (`id`),
  INDEX `uid` (`uid` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '试用InnoDB，这个表写入比较多，查询比较少';


-- -----------------------------------------------------
-- Table `mytest`.`follow`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`follow` ;

CREATE TABLE IF NOT EXISTS `mytest`.`follow` (
  `follow_uid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '跟随用户uid, 主动跟随的ID，被跟随用户',
  `fans_uid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '粉丝用户uid，主动发起跟随，成为别人的粉丝的用户id',
  `gid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '这个是follow group id = gid',
  `time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '跟随和被跟随事件发生的时间',
  INDEX `follow_uid` (`follow_uid` ASC),
  INDEX `fans_uid` (`fans_uid` ASC),
  INDEX `gid` (`gid` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '用户关注与粉丝表';


-- -----------------------------------------------------
-- Table `mytest`.`follow_group`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`follow_group` ;

CREATE TABLE IF NOT EXISTS `mytest`.`follow_group` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '哪个用户创建的关注分组 用户的uid',
  `name` CHAR(20) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `uid` (`uid` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '关注分组表';


-- -----------------------------------------------------
-- Table `mytest`.`letter`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`letter` ;

CREATE TABLE IF NOT EXISTS `mytest`.`letter` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '私信表',
  `to_uid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '私信发送给谁',
  `to_nickname` CHAR(20) NOT NULL DEFAULT '' COMMENT '收信人姓名昵称nickname',
  `from_uid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发信用户ID',
  `from_nickname` CHAR(20) NOT NULL DEFAULT '' COMMENT '发件人姓名昵称nickname',
  `content` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '私信内容，255个字符以内',
  `send_time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '私信发送时间',
  `read_time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '阅读时间0=未读 NEQ0 已读',
  `type` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '私信类型0=普通 1=系统 2=通知 3=活动',
  `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '状态0=未读1=已读3=逻辑删除回收站 4=销毁destroy',
  PRIMARY KEY (`id`),
  INDEX `to_uid` (`to_uid` ASC),
  INDEX `from_uid` (`from_uid` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '私信表';


-- -----------------------------------------------------
-- Table `mytest`.`comment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`comment` ;

CREATE TABLE IF NOT EXISTS `mytest`.`comment` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键，评论主键',
  `tid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '评论的主题id，topic_id',
  `uid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户uid',
  `nickname` CHAR(20) NOT NULL DEFAULT '',
  `content` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '评论内容',
  `is_turn` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否转发，0=原创，如果是转发，则保存原始id回复',
  `time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '评论发布时间',
  `turn_num` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '转发，回复次数',
  `fav_num` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '收藏次数，喜欢次数，点赞次数',
  `reply_num` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '被评论回复的次数',
  `classify_id` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '评论所属的分类id',
  `channel_id` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '评论所属的频道id',
  PRIMARY KEY (`id`),
  INDEX `tid` (`tid` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '评论表';


-- -----------------------------------------------------
-- Table `mytest`.`gambit`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`gambit` ;

CREATE TABLE IF NOT EXISTS `mytest`.`gambit` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(100) NOT NULL DEFAULT '',
  `content` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '话题内容',
  `uid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发起话题的用户UID',
  `nickname` CHAR(20) NOT NULL DEFAULT '' COMMENT '发起话题的用户昵称',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '话题表主题表';


-- -----------------------------------------------------
-- Table `mytest`.`atme`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`atme` ;

CREATE TABLE IF NOT EXISTS `mytest`.`atme` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '提到的人的id，@31526的id',
  `cid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '提到用户的评论ID，commentID= CID用户在哪个评论里at了我',
  `nid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '谁at的我中的这个誰who',
  `time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '本条at发生的时间',
  `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '状态0未读1已经读',
  PRIMARY KEY (`id`),
  INDEX `cid` (`cid` ASC),
  INDEX `uid` (`uid` ASC),
  INDEX `nid` (`nid` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '提到我的 表';


-- -----------------------------------------------------
-- Table `mytest`.`user_active`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`user_active` ;

CREATE TABLE IF NOT EXISTS `mytest`.`user_active` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '待激活用户的uid',
  `key` CHAR(10) NOT NULL DEFAULT '' COMMENT '加密&解密 本条信息所需要的的密钥',
  `time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '验证请求生成时间',
  `uidcode` CHAR(32) NOT NULL DEFAULT '' COMMENT 'UID通过专用的key生成的加密MD5字符串',
  `emailcode` CHAR(32) NOT NULL DEFAULT '',
  `mobilecode` CHAR(10) NOT NULL DEFAULT '',
  `destroy` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '本条数据是否被销毁，1为销毁，0为未销毁',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
COMMENT = '用户激活招回密码等加密数据存储表';


-- -----------------------------------------------------
-- Table `mytest`.`company`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`company` ;

CREATE TABLE IF NOT EXISTS `mytest`.`company` (
  `id` INT(10) UNSIGNED NOT NULL,
  `name` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '公司名称',
  `alias` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '公司别名',
  `scale` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '公司规模，0=未知',
  `license` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '营业执照',
  `code` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '组织机构代码证',
  `tax` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '税务登记证',
  `tel` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '电话号码',
  `fax` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '传真号码',
  `address` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '公司地址',
  `zipcode` VARCHAR(10) NOT NULL DEFAULT '',
  `robot` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否为机器人灌入的公司',
  `register_time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '注册时间',
  `lock` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否锁定',
  `authentication` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否认证，加V，执照，电话认证',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '公司信息表';


-- -----------------------------------------------------
-- Table `mytest`.`company_scale`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`company_scale` ;

CREATE TABLE IF NOT EXISTS `mytest`.`company_scale` (
  `id` SMALLINT(5) UNSIGNED NOT NULL,
  `name` VARCHAR(50) NOT NULL DEFAULT '',
  `order_num` SMALLINT(5) UNSIGNED NOT NULL DEFAULT 65535 COMMENT 'order_num-排序字段',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '公司规模，企业规模';


-- -----------------------------------------------------
-- Table `mytest`.`company_industry`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`company_industry` ;

CREATE TABLE IF NOT EXISTS `mytest`.`company_industry` (
  `id` SMALLINT(5) UNSIGNED NOT NULL,
  `name` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '公司所属行业名称',
  `fid` SMALLINT(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父级别id，0为根级别',
  `order_num` SMALLINT(5) UNSIGNED NOT NULL DEFAULT 65535 COMMENT '排序字段',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '行业类型';


-- -----------------------------------------------------
-- Table `mytest`.`user_checkin`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`user_checkin` ;

CREATE TABLE IF NOT EXISTS `mytest`.`user_checkin` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户签到记录的主键ID，自增',
  `uid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `nickname` CHAR(20) NOT NULL DEFAULT '',
  `time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '签到时间',
  `ip` CHAR(15) NOT NULL DEFAULT '' COMMENT '签到的ip地址',
  PRIMARY KEY (`id`),
  INDEX `uid` (`uid` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '签到打卡表';


-- -----------------------------------------------------
-- Table `mytest`.`user_gold_log`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`user_gold_log` ;

CREATE TABLE IF NOT EXISTS `mytest`.`user_gold_log` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `uid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户uid',
  `nickname` CHAR(20) NOT NULL DEFAULT '' COMMENT '冗余的用户昵称',
  `time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '日志发生的时间',
  `num` SMALLINT(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '变动数量',
  `change` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0=减少1=增加',
  `type` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '交易类型，0=系统，1=打卡签到，2=编辑评分，3=日常操作，4=投稿，5=加精，6=活动，7=未知',
  `remark` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '注释备注',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '用户金币增减日子表';


-- -----------------------------------------------------
-- Table `mytest`.`channel`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`channel` ;

CREATE TABLE IF NOT EXISTS `mytest`.`channel` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '频道分类ID',
  `name` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '频道名称',
  `fid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父级别id',
  `order_num` SMALLINT(5) UNSIGNED NOT NULL DEFAULT 65535 COMMENT '排序字段',
  `remark` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '备注说明',
  `lock` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '是否锁定',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '频道分类表';


-- -----------------------------------------------------
-- Table `mytest`.`classify`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`classify` ;

CREATE TABLE IF NOT EXISTS `mytest`.`classify` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '分类表的自曾id',
  `name` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '分类名称',
  `fid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父级别id',
  `order_num` SMALLINT(5) UNSIGNED NOT NULL DEFAULT 65535 COMMENT '排序字段',
  `remark` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '备注说明',
  `lock` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '是否锁定',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '分类表';


-- -----------------------------------------------------
-- Table `mytest`.`topic`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`topic` ;

CREATE TABLE IF NOT EXISTS `mytest`.`topic` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '作者ID',
  `nickname` CHAR(20) NOT NULL DEFAULT '' COMMENT '作者姓名',
  `source` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '文章来源',
  `title` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '文章标题，',
  `alias` VARCHAR(100) NOT NULL DEFAULT '' COMMENT 'seo个性标题直接搜索用的，暂时先不索引，以后可能会需要加索引',
  `cover` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '封面图impress印象图',
  `summary` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '文章摘要，简介',
  `content` VARCHAR(20000) NOT NULL DEFAULT '' COMMENT '文章内容',
  `publish_time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发布时间',
  `begin_time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '定时发布的选项时间，如果有时间就定时发布，没有就直接发布',
  `end_time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '过期时间，如果为0，就没有过期时间',
  `view_num` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '阅读次数',
  `type` TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'topic文章话题t主的类型：0=文章 1=问答 2=讨论社区 3=用户发布的内容',
  `robot` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否机器人灌水的内容',
  `lock` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否锁定的文章',
  `channel_id` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '频道ID名称',
  `classify_id` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '分类名称',
  `access` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '阅读权限默认0=无需权限',
  `keyword` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '冗余的tag，也就是keyword做SEO使用的',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '文章表Topic主题';


-- -----------------------------------------------------
-- Table `mytest`.`tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`tag` ;

CREATE TABLE IF NOT EXISTS `mytest`.`tag` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增主键id',
  `name` CHAR(20) NOT NULL DEFAULT '' COMMENT 'tag标签名称',
  `level` TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'tag的等级，默认=0，未分级别，9级别最高，1最低，优先级，排热度的时候使用',
  `num` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '当前tag一共有多少个，计划任务，每天夜晚查询',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'tag便签表';


-- -----------------------------------------------------
-- Table `mytest`.`feedback`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`feedback` ;

CREATE TABLE IF NOT EXISTS `mytest`.`feedback` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '反馈信息id',
  `uid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '如果用户登录，则写入用户uid',
  `nickname` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '如果是登录用户则取下nickname，如果不是则为空',
  `content` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '反馈内容',
  `qq` VARCHAR(20) NOT NULL DEFAULT '',
  `email` VARCHAR(50) NOT NULL DEFAULT '',
  `mobile` VARCHAR(50) NOT NULL DEFAULT '',
  `time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '反馈提交时间',
  `type` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户反馈的类型，0=默认,1=意见建议，2=投诉，3=bug报错。',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '用户反馈数据表';


-- -----------------------------------------------------
-- Table `mytest`.`user_address`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`user_address` ;

CREATE TABLE IF NOT EXISTS `mytest`.`user_address` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID自增',
  `uid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户id索引',
  `name` CHAR(10) NOT NULL DEFAULT '' COMMENT '收件人姓名',
  `gender` TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '性别1=男 和 0=女',
  `zipcode` CHAR(6) NOT NULL DEFAULT '' COMMENT '6位数字的邮政编码',
  `country` CHAR(10) NOT NULL DEFAULT '' COMMENT 'shengfen省份',
  `province` CHAR(10) NOT NULL DEFAULT '' COMMENT '省份',
  `city` CHAR(10) NOT NULL DEFAULT '' COMMENT '城市',
  `area` CHAR(10) NOT NULL DEFAULT '' COMMENT '区县地址',
  `address` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '收件详细地址',
  `receipt_num` SMALLINT(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '本地址的收货量',
  PRIMARY KEY (`id`),
  INDEX `uid` (`uid` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '用户的多个收货地址';


-- -----------------------------------------------------
-- Table `mytest`.`lucky`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`lucky` ;

CREATE TABLE IF NOT EXISTS `mytest`.`lucky` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sign` SMALLINT(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '抽奖活动的标记',
  `uid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户uid',
  `nickname` CHAR(20) NOT NULL DEFAULT '' COMMENT '用户昵称，冗余设计',
  `code` CHAR(10) NOT NULL DEFAULT '' COMMENT '用户提交的彩票代码，一般为4位数字就够了',
  `time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '下注时间',
  `slogan` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '用户中奖宣言slogan口号',
  `remark` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '管理员备注信息',
  PRIMARY KEY (`id`),
  INDEX `sign` (`sign` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '彩票抽奖信息表';


-- -----------------------------------------------------
-- Table `mytest`.`medal`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`medal` ;

CREATE TABLE IF NOT EXISTS `mytest`.`medal` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` CHAR(20) NOT NULL DEFAULT '' COMMENT '勋章的名称',
  `remark` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '如何能得到本勋章的说明',
  `type` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '勋章的种类，系统颁发，手工颁发？',
  `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '状态，0=未启用 1=启用',
  `icon` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '勋章的图标地址URL地址',
  `class` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '勋章如果是用class-icon显示，那么class的名称',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '勋阶medal勋章，贡献奖章';


-- -----------------------------------------------------
-- Table `mytest`.`user_medal`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`user_medal` ;

CREATE TABLE IF NOT EXISTS `mytest`.`user_medal` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户id',
  `mid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '勋章id Medal_ID',
  PRIMARY KEY (`id`),
  INDEX `uid` (`uid` ASC),
  INDEX `mid` (`mid` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '用户与勋章的中间表关联表，多对多的关系';


-- -----------------------------------------------------
-- Table `mytest`.`headline`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`headline` ;

CREATE TABLE IF NOT EXISTS `mytest`.`headline` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'TopicID文章话题主体的ID=Tid',
  `begin_time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上头条开始显示的时间属于预发布',
  `end_time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '头条状态结束时间',
  `color` CHAR(6) NOT NULL DEFAULT '000000' COMMENT '颜色，rgb颜色色值',
  `title` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '冗余一个标题',
  `channel_id` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '频道ID',
  `classify_id` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '分类id',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '头条数据表，保存各个频道，分类，板块的头条和次头条数据';


-- -----------------------------------------------------
-- Table `mytest`.`picture`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`picture` ;

CREATE TABLE IF NOT EXISTS `mytest`.`picture` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上传用户',
  `nickname` CHAR(20) NOT NULL DEFAULT '' COMMENT '上传用户的nickname',
  `time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '图片上传时间',
  `width` SMALLINT(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '图片的宽度',
  `height` SMALLINT(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '图片的高度',
  `size` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '图片的大小SIZE= ? Byte',
  `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '图片的状态0=默认 未审核显示，1正常默认',
  `private` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否是私有的图片1=yes 0=no',
  `type` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Album相册专辑id，默认为0，无相册概念',
  `summary` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '图片摘要说明，简单介绍',
  `remark` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '图片备注说明管理员使用的',
  `url` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '图片地址本地或者网络地址',
  `channel_id` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '频道id',
  `classify_id` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '分类id',
  `album_id` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '相册id',
  `cloud_id` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '云存储的id=0本地存储1=upyun又拍云2=七牛云3=aliyun',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '图片配图瀑布流等图片信息数据表';


-- -----------------------------------------------------
-- Table `mytest`.`question`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`question` ;

CREATE TABLE IF NOT EXISTS `mytest`.`question` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `uid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '提问者id',
  `nickname` CHAR(20) NOT NULL DEFAULT '' COMMENT '提问者昵称',
  `content` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '问题内容',
  `adopt` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '采纳的回答id',
  `reward` SMALLINT(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '奖励，悬赏的金币数量',
  `time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发布时间',
  `finish` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否结束，结束1，0=未结束',
  `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '状态，是否结贴1=结贴，0=未结贴',
  `answer_num` SMALLINT(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '回答数量',
  PRIMARY KEY (`id`),
  INDEX `uid` (`uid` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '问答频道的问题表';


-- -----------------------------------------------------
-- Table `mytest`.`answer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`answer` ;

CREATE TABLE IF NOT EXISTS `mytest`.`answer` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `nickname` CHAR(20) NOT NULL DEFAULT '',
  `qid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '所回答的问题的id，question_id',
  `content` VARCHAR(1000) NOT NULL DEFAULT '' COMMENT '问题的回答',
  `time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '回答时间',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '问题的回答';


-- -----------------------------------------------------
-- Table `mytest`.`bookmark`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`bookmark` ;

CREATE TABLE IF NOT EXISTS `mytest`.`bookmark` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '收藏的书签的URL，索引INDEX方便查询',
  `title` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '书签标题',
  `icon` VARCHAR(100) NOT NULL DEFAULT '',
  `classname` VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'icon_class_name',
  `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  `lock` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '本标签是否锁定',
  PRIMARY KEY (`id`),
  INDEX `url` (`url` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '书签，用户收藏和浏览的URL地址书签记录或者用户自己保存的快捷书签';


-- -----------------------------------------------------
-- Table `mytest`.`user_bookmark`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`user_bookmark` ;

CREATE TABLE IF NOT EXISTS `mytest`.`user_bookmark` (
  `uid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `bid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `time` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `gid` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Bookmark_Group分组id',
  `remark` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '用户备注标记',
  INDEX `uid` (`uid` ASC),
  INDEX `bid` (`bid` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '用户和标签关联中间表';


-- -----------------------------------------------------
-- Table `mytest`.`picture_album`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mytest`.`picture_album` ;

CREATE TABLE IF NOT EXISTS `mytest`.`picture_album` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` CHAR(20) NOT NULL DEFAULT '' COMMENT '专辑名称',
  `remark` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '描述',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '图片专辑表';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
