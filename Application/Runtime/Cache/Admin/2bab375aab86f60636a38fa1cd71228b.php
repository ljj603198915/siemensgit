<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台模板</title>

    <script type="text/javascript" src="<?php echo AdminJsUrl;?>jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo AdminJsUrl;?>index.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo AdminCssUrl;?>jquery-ui.min.css">

    <link rel="stylesheet" href="<?php echo AdminCssUrl;?>add.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo AdminCssUrl;?>bootstrap.min.css" type="text/css"/>
</head>
<body>
    <!-- <?php if($_page_btn_name): ?>
    <span class="action-span"><a href="<?php echo $_page_btn_link; ?>"><?php echo $_page_btn_name; ?></a></span>
    <?php endif; ?>
    <span class="action-span1"><a href="#">管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo $_page_title; ?> </span>
    <div style="clear:both"></div>
 -->
    <div class="route_bg">
        <span>管理中心</span>
        <i class="glyph-icon icon-chevron-line"></i>
        <span><?php echo $_page_title; ?></span>
        <i class="glyph-icon icon-chevron-right"></i>
        <?php if($_page_btn_name): ?>
        <a href="<?php echo $_page_btn_link; ?>" target="menuFrame"><?php echo $_page_btn_name; ?></a>
        <?php endif; ?>
    </div>
<!--  内容  -->

<div class="div_from_aoto" style="width: 500px;">
    <!--<form name="main_form" method="POST" action="/index.php/Admin/Problem/add" enctype="multipart/form-data">-->

        <div class="control-group">
            <label class="laber_from">题干名称<sup style="color: red;">*</sup></label>
            <div class="controls"><input class="input_from" name="problem_name" type='text'>
                <P class=help-block></P></div>
        </div>
        <div class="control-group">
            <label class="laber_from">题干类型<sup style="color: red;">*</sup></label>
            <div class="controls">
                <select class="input_select" name="problem_type">
                    <option value="">请选择</option>
                    <option value="1">常见问题</option>
                    <option value="2">产品问题</option>
                    <option value="3">接线问题</option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="laber_from">题干名称<sup style="color: red;">*</sup></label>
            <div class="controls"><textarea name="answer" id="myEditor">这里写你的初始化内容</textarea></div>
        </div>
        <div class="control-group">
            <label class="laber_from">状态<sup style="color: red;">*</sup></label>
            <div class="controls">
                <select class="input_select" name="is_use">
                    <option value="1">启用</option>
                    <option value="0">停用</option>
                </select>
            </div>
        </div>
        <DIV class="control-group">
            <LABEL class="laber_from"></LABEL>
            <DIV class="controls">
                <button type="submit" class="sub btn btn-primary" value="确认">确认</button>
                <button type="reset" class="btn btn-primary" value="重置">重置</button>

            </DIV>
        </DIV>

    <div class="show"></div>


    <!--</form>-->
</div>
<script type="text/javascript" charset="utf-8" src="<?php echo AdminPublicUrl;?>utf8-php/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo AdminPublicUrl;?>utf8-php/ueditor.all.js"></script>
<script type="text/javascript" src="<?php echo AdminPublicUrl;?>utf8-php/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">

    var editor = new UE.ui.Editor();

    editor.render("myEditor");

    $(".sub").click(function () {
        var content = editor.getPlainTxt();

        console.log(content);

        var content1=editor.getContent();
        console.log(content1)

        $(".show").html(content1);
    })

    //1.2.4以后可以使用一下代码实例化编辑器 

    //UE.getEditor(’myEditor’) 

</script>


</body>
</html>