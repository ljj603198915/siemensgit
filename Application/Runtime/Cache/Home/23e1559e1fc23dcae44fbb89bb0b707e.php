<?php if (!defined('THINK_PATH')) exit();?>
<!--  内容  -->

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>在线购买</title>
		<link rel="stylesheet" href="<?php echo HomeCssUrl;?>/reset.css" />
		<link rel="stylesheet" href="<?php echo HomeCssUrl;?>/aa.css" />

	</head>

	<body>
		<div class="container">
			<div class="Interbuy_img"></div>
			<br />
			<div class="store">
				<ul class="store_ul">
					<li><div class="shop_div">旗舰店</div></li>
					<?php if(is_array($shop_data)): foreach($shop_data as $key=>$v): if($v['shop_type'] == 1 ): ?><li class="shop"><a href="<?php echo ($v["shop_url"]); ?>"><?php echo ($v["shop_name"]); ?><span>>></span></a></li><?php endif; endforeach; endif; ?>
				</ul>

                <ul class="store_ul">
                	<li><div class="shop_div">专卖店</div></li>
					<?php if(is_array($shop_data)): foreach($shop_data as $key=>$v): if($v['shop_type'] == 2 ): ?><li class="shop"><a href="<?php echo ($v["shop_url"]); ?>"><?php echo ($v["shop_name"]); ?><span>>></span></a></li><?php endif; endforeach; endif; ?>
                </ul>
				<ul class="store_ul">
					<li><div class="shop_div">平台专营店</div></li>
					<?php if(is_array($shop_data)): foreach($shop_data as $key=>$v): if($v['shop_type'] == 3 ): ?><li class="shop"><a href="<?php echo ($v["shop_url"]); ?>"><?php echo ($v["shop_name"]); ?><span>>></span></a></li><?php endif; endforeach; endif; ?>
				</ul>

                <ul class="store_ul">
                	<li><div class="shop_div">平台自营店</div></li>
					<?php if(is_array($shop_data)): foreach($shop_data as $key=>$v): if($v['shop_type'] == 4 ): ?><li class="shop"><a href="<?php echo ($v["shop_url"]); ?>"><?php echo ($v["shop_name"]); ?><span>>></span></a></li><?php endif; endforeach; endif; ?>
                </ul>
                <div style="height: 60px;"></div>
			</div>
		</div>
	</body>

</html>
<div class="footer">
    <ul>
        <li>
            <a href="http://www.wawechat.siemens.com.cn/Home/Product/ssy_product"><img src="<?php echo HomeImgUrl;?>/product.png">
                <br />了解产品</a>
        </li>
        <li>
            <a href="http://www.wawechat.siemens.com.cn/Home/Select/select_lst"><img src="<?php echo HomeImgUrl;?>/heart.png">
                <br />自助选型</a>
        </li>
        <li>
            <a href="http://www.wawechat.siemens.com.cn/Home/Checkproduct/index"><img src="<?php echo HomeImgUrl;?>/glass.png">
                <br />产品验真</a>
        </li>
        <li>
            <a href="http://www.wawechat.siemens.com.cn/Home/Onshop/onshop"><img src="<?php echo HomeImgUrl;?>/fenzhi.png">
                <br />在线购买</a>
        </li>
        <li>
            <a href="http://www.wawechat.siemens.com.cn/Home/Nearshop/shop"><img src="<?php echo HomeImgUrl;?>/position.png">
                <br />附近店铺</a>
        </li>
    </ul>
</div>