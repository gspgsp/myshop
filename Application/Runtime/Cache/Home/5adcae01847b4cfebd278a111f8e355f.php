<?php if (!defined('THINK_PATH')) exit();?><div class="buy-title">
	<h2>产品明细</h2>
	<span>总价：<i class="total" id="totalPrice"><?php echo ($totalPrice); ?></i>元 <b class="sum" id="sum">总数量：<em><?php echo ($totalWeights); ?></em>吨</b><b class="sum" id="cnum">选购数：<em><?php echo ($totalNums); ?></em>笔</b></span>
</div>
<table id="cart">
	<tr>
		<th>产品名称</th>
		<th>牌号</th>
		<th width="140">厂家</th>
		<th>交货地</th>
		<th width="140">数量</th>
		<th>单位</th>
		<th width="120">单价</th>
		<th width="120">金额</th>
		<th width="100">操作</th>
	</tr>
	<!-- {foreach from=$cartList item=value key=key} -->
	<?php if(is_array($cartList)): foreach($cartList as $key=>$value): ?><tr class="details" data-cart-id="<?php echo ($value["options"]["p_id"]); ?>">
			<td><?php echo ($value["options"]["product_type"]); ?></td>
			<td data-model="<?php echo ($value["options"]["model"]); ?>"><?php echo ($value["options"]["model"]); ?></td>
			<td data-fname="<?php echo ($value["options"]["f_name"]); ?>"><?php echo ($value["options"]["f_name"]); ?></td>
			<td><?php echo ($value["options"]["city"]); ?></td>
			<td class="amount">
				<input type="text" name="num" style="width: 60px" value="<?php echo ($value["number"]); ?>" id="<?php echo ($value["options"]["p_id"]); ?>" data-curid="<?php echo ($key); ?>" data-allweights="<?php echo ($value["number"]); ?>"/>
			</td>
			<td>吨</td>
			<td class="d-price"><span><?php echo ($value["options"]["unit_price"]); ?></span>元</td>
			<td class="money"><?php echo ($value["total"]); ?></td>
			<td class="opt">
				<a href="javascript:;" onClick="delMyCart('<?php echo ($key); ?>',this)">删除</a>
			</td>
		</tr><?php endforeach; endif; ?>
	<!-- <a href="javascript:;" onClick="delCart('<?php echo ($key); ?>',this)">删除</a> -->
	<!-- {/foreach} -->
</table>
<script>
var weights,curid,allweights;
$(function(){
	$("input[name='num']").on('blur',function(e){
		weights = parseFloat($(this).val());//当前数值
		curid = $(this).data('curid');
		allweights = $(this).data('allweights');//总数值
		if(weights > allweights){
			var that = $(this);
			layer.msg('超过商家上架数量!最多能购买'+allweights+'吨',2,3);
			$(this).val(allweights);
		}else{
			//重新计算
			calculateWeights();
			//后台请求更改数据
			$.post('Home/Cart/setCart',{id:curid,number:weights},function(res){
				if(res.err == 0){
					load_cart();
					// $('#load-cart').load($('#load-cart').data('url'));
				}else{
					layer.msg(res.msg,1,3);
				}
			},'json');
		}
	});
});
var calculateWeights = function (){
	var totalPrice = 0,number = 0,price = 0,sum=0;
	$('.details').each(function(i,v){
		number = parseFloat($(v).find('input[name="num"]').val());
		price = parseFloat($(v).find('.d-price span').text());
		totalPrice += number*price;
		sum += number;
	});
	$("#sum em").text(sum);
	$("#totalPrice").text(totalPrice);
}
//删除产品
function delMyCart(id,that){
	$.ajax({
	    url:'/Home/Offers/delCart',
	    type:'post',
	    data:{sid:id},
	    // cache:false,
	    dataType:'json',
	    async : false,     //设置同异步 false:同步  true:异步
	    success:function(res){
	        if(res.err==0){
	        	$(that).parents('tr').remove();
	            load_cart();
	            if($("#cart .details").size()==0){
	                window.location.href="/Offers";
	            }
	        }

	    }
	})
}
</script>