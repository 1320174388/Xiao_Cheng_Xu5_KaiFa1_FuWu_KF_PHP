<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  talk_v1_sql.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/30 20:51
 *  文件描述 :  数据库表迁移文件，删除/创建模块应用表
 *  历史记录 :  -----------------------
 */
    $config = [
        'host'      => 'gz-cdb-9yvp3vjn.sql.tencentcdb.com', // 数据库地址
        'port'      => '63119',                              // 数据库端口
        'database'  => 'langxue2nanfengmeilin',              // 数据库名称
        'charset'   => 'utf8',                               // 设置字符集
        'user'      => 'root',                               // 用户名称
        'password'  => 'CBBBBBEIMbc01z',                     // 用户密码
    ];

    $table = [
        'replys'   => 'data_session_replys',   // 客服回复信息表
        'people'   => 'data_session_peoples',  // 留言人信息表
        'leavings' => 'data_session_leavings', // 留言表
        'messages' => 'data_session_messages', // 留言信息表
    ];

	$date     =  date('Y-m-d H:i:s',time());

	// 连接数据库
    $server  = 'mysql:host='.$config['host'].';';

    $server .= 'port='.$config['port'].';';

    $server .= 'dbname='.$config['database'].';';

    $server .= 'charset='.$config['charset'].';';

    $pdo = new pdo($server,$config['user'],$config['password']);
	
	// 开启事务
	$pdo->beginTransaction();
	
	try{

	    // 删除客服回复信息表
	    $pdo->exec('drop table '.$table['replys'].';');
	    echo '
删除 '.$table['replys'].' 客服回复信息表
';
        // 删除留言人信息表
        $pdo->exec('drop table '.$table['people'].';');
        echo '删除 '.$table['people'].' 留言人信息表
';
        // 删除留言表
        $pdo->exec('drop table '.$table['leavings'].';');
        echo '删除 '.$table['leavings'].' 留言表
';
        // 删除留言信息表
        $pdo->exec('drop table '.$table['messages'].';');
        echo '删除 '.$table['messages'].' 留言信息表
';

        // 创建客服回复信息表
		$pdo->exec('create table '.$table['replys'].'(
			session_index varchar(50) primary key,
            session_name varchar(50),
			session_type varchar(50),
			session_content text(2000),
			session_time varchar(50)
		);');
		echo '
创建 '.$table['replys'].' 客服回复信息表
';
        // 创建留言人信息表
        $pdo->exec('create table '.$table['people'].'(
            people_index varchar(50) primary key,
            people_name varchar(50),
            people_sex varchar(50),
            people_status varchar(50),
            people_time varchar(50)
        );');
        echo '创建 '.$table['people'].' 留言人信息表
';
        // 创建留言表
        $pdo->exec('create table '.$table['leavings'].'(
            leaving_index varchar(50) primary key,
            people_index varchar(50),
            leaving_title varchar(50),
            leaving_status varchar(50),
            leaving_time varchar(50),
            leaving_handle varchar(50)
        );');
        echo '创建 '.$table['leavings'].' 留言表
';
        // 创建留言信息表
        $pdo->exec('create table '.$table['messages'].'(
            leaving_index varchar(50) primary key,
            message_content text(2000),
            message_identity varchar(50),
            message_sort int(11) unsigned
        );');
        echo '创建 '.$table['messages'].' 留言信息表
';

		// 添加成功
		$pdo->commit();
		echo '
success
';

    }catch(PDOException $e){
    	// 添加失败
    	$pdo->rollback();
        echo $e->getMessage();
    }   
    