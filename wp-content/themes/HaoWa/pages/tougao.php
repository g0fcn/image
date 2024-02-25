<?php
/**
* Template Name: 发布模板
* 作者：学做网站论坛
* 博客:http://93665.xin/
*/if( isset($_POST['tougao_form']) && $_POST['tougao_form'] == 'send') {
global $wpdb;
$current_url = 'http://93665.xin/'; // 注意修改此处的链接地址$last_post = $wpdb->get_var("SELECT `post_date` FROM `$wpdb->posts` ORDER BY `post_date` DESC LIMIT 1");// 表单变量初始化
$name = isset( $_POST['tougao_authorname'] ) ? trim(htmlspecialchars($_POST['tougao_authorname'], ENT_QUOTES)) : '';
$email = isset( $_POST['tougao_authoremail'] ) ? trim(htmlspecialchars($_POST['tougao_authoremail'], ENT_QUOTES)) : '';
$blog = isset( $_POST['tougao_authorblog'] ) ? trim(htmlspecialchars($_POST['tougao_authorblog'], ENT_QUOTES)) : '';
$title = isset( $_POST['tougao_title'] ) ? trim(htmlspecialchars($_POST['tougao_title'], ENT_QUOTES)) : '';
$category = isset( $_POST['cat'] ) ? (int)$_POST['cat'] : 0;
$content = isset( $_POST['tougao_content'] ) ? trim($_POST['tougao_content']) : '';
$content = str_ireplace('?>', '?&gt;', $content);
$content = str_ireplace('<?', '&lt;?', $content);
$content = str_ireplace('<script', '&lt;script', $content);
$content = str_ireplace('<a ', '<a rel="external nofollow" ', $content);// 表单项数据验证

if ( empty($blog) || strlen($blog) > 30) {
wp_die('网址必须填写，且长度不得超过30字，格式hhttp://93665.xin/)。<a href="'.$current_url.'">点此返回</a>');
}

if ( empty($title) || mb_strlen($title) > 10 ) {
wp_die('网站标题必须填写，且长度不得超过10字。<a href="'.$current_url.'">点此返回</a>');
}

    $tougao = array(
        'post_title' => $title,                //标题
        'post_content' => $content,            //内容
        'post_status' => 'pending',            //待审
        'tags_input' => $tags,                 //标签
        'post_category' => array($category)    //分类
    );

// 将文章插入数据库
$status = wp_insert_post( $tougao );
 //将自定义域写入最新待审文章
        global $wpdb;
        $myposts = $wpdb->get_results("
            SELECT ID
            FROM $wpdb->posts
            WHERE post_status = 'pending'
            AND post_type = 'post'
            ORDER BY post_date DESC
        ");
        add_post_meta($myposts[0]->ID, 'author', $name);    //插入投稿人昵称的自定义域
        if ( !empty($blog)) add_post_meta($myposts[0]->ID, 'source', $blog);    //插入投稿人网址的自定义域
        
        setcookie("tougao", time(), time()+180);
        echo   '<p align="center"><a href="';bloginfo('siteurl');;echo '/" title="返回首页">返回首页</a></p>';

if ($status != 0) {
// 投稿成功给博主发送邮件
// 840263997@qq.com替换博主邮箱
// My subject替换为邮件标题，content替换为邮件内容
wp_mail("somebody#example.com","My subject","content");

wp_die('投稿成功！感谢投稿！<a href="'.$current_url.'">点此返回</a>', '投稿成功');
}
else {
wp_die('投稿失败！<a href="'.$current_url.'">点此返回</a>');
}
} get_header();?>
<?php if (have_posts()) : while (have_posts()) : the_post();?>
<link href="<?php bloginfo('template_url');?>/style.css" rel="stylesheet">
<style>
.content .row {
	padding: 15px 25px 20px 25px;
}
.items p {
	line-height: 26px;
	font-size: 14px;
}
.items img {
	max-width: 100%;
}
.aligncenter {
	display: block;
	margin-left: auto;
	margin-right: auto;
}
.aligncenter p.wp-caption-text {
	display: block;
	margin-left: auto;
	margin-right: auto;
	text-align: center;
}
</style>
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-1 sidebar">
        <div class="content-sidebar">
          <dl id="goto">
            <dt style="top: 10.5px;"><span class="show-list"></span></dt>
          </dl>
        </div>
      </div>
      <div class="col-md-11">
        <div class="part current" id="web" data-title="<?php the_title();?>">
          <h2 class=""><strong>
            <?php the_title();?>
            </strong></h2>
          <div class="items">
            <div class="row">
              <p>
                <?php the_content('Read more...');?>
 <!-- 关于表单样式，请自行调整-->
 <form class="ludou-tougao" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; $current_user = wp_get_current_user(); ?>">
 
 
 <div style="text-align: left; padding-top: 10px;">
 <label for="tougao_title">网站标题:*</label><br/>
 <input style="width:100%;height:30px;line-height:30px" type="text" size="40" value="" id="tougao_title" name="tougao_title" />
 </div>
<div style="text-align: left; padding-top: 10px;">
 <label for="tougao_authorblog">网站地址:*</label><br/>
 <input style="width:100%;height:30px;line-height:30px" type="text" size="40" value="" id="tougao_authorblog" name="tougao_authorblog" />
 </div>
<div class="descr">
（如http(s)://93665.xin/）</div>
 <div style="text-align: left; padding-top: 10px;">
 <label for="tougao_tags">关键词:*</label><br/>
 <input style="width:100%;height:30px;line-height:30px" type="text" size="40" value="" id="tougao_ tags" name="tougao_tags" /> 
 </div>
<div class="descr">（多个标签请用英文逗号 , 分开）</div>
 <div class="feilei" style="text-align: left; padding-top: 10px;">
 <label for="tougaocategorg">网站分类:*</label><br/>
<?php wp_dropdown_categories('show_count=1&hierarchical=1'); ?>
 </div>
<div class="descr">（logo地址放网站描述里面）</div>
  <div style="text-align: left; padding-top: 10px;">
 <label style="vertical-align:top" for="tougao_content">网站描述:*</label><br/>
 <textarea style="width:100%;height:300px" rows="15" cols="55" id="tougao_content" name="tougao_content"></textarea>
 </div>

 
 <br clear="all">
 <div style="text-align: center; padding-top: 10px;">
 <input type="hidden" value="send" name="tougao_form" />
 <input style="width:100px;height:30px;line-height:30px;background:#39F;color:#FFF" type="submit" value="提交" />
 <input style="width:100px;height:30px;line-height:30px;background:#39F;color:#FFF" type="reset" value="重填" />
 </div>
 </form>
<script charset="utf-8" src="<?php bloginfo('template_url'); ?>/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="<?php bloginfo('template_url'); ?>/kindeditor/lang/zh_CN.js"></script>
<script>
/* 编辑器初始化代码 start */
var editor;
KindEditor.ready(function(K) {
editor = K.create('#tougao_content', {
resizeType : 1,
allowPreviewEmoticons : false,
allowImageUpload : true, /* 开启图片上传功能，不需要就将true改成false */
items : [
'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
'insertunorderedlist', '|', 'emoticons', 'image', 'link']
});
});
/* 编辑器初始化代码 end */
</script>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endwhile;else: ;endif;?>
<?php get_footer(); ?>
