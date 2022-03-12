<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit</title>

	<style type="text/css">
		.conf_block {
			display: block;
			text-overflow: ellipsis;
			overflow: hidden;
			width: 20%;
			border-radius: 10px;
			border: 1px solid darkgrey;
			transition: all .5s;
		}
		.popup {
			border-top: 1px solid rgba(0, 0, 0, 0.0);
			transition: all .5s;
			height: 0px;
		}
	</style>

</head>
<body>
	<div class="all_red_info">
		<div class="conf_block">
			<div class="always_visible" onclick="on_conf_click('cb_1')">
				<span> test </span>	<br>
				<span> test </span>	<br>	
			</div>
			<div class="popup" id="cb_1">
				<span> test </span>	<br>
				<span> test </span>	<br>
				<span> test </span>	<br>
				<span> test </span>	<br>
				<span> test </span>		
			</div>
		</div>
	</div>
	<div onclick="addElement()" style="background: red; border-radius: 20px; width: 20px;"><span>+</span></div>
</body>
<input type="date">
</html>

<script type="text/javascript">
		var visible = false;
		function on_conf_click(conf_id) {
			var cur_conf = document.getElementById(conf_id);
			//var sep = cur_conf.getElementsByClassName()
			if (!visible) {
				visible = true;
				cur_conf.style.borderTop = "1px solid darkgrey";
				cur_conf.style.height = "100px";
			} else {
				visible = false;
				cur_conf.style.borderTop = "1px solid rgba(0, 0, 0, 0.0)";
			 	cur_conf.style.height = "0px";
			 }
		}

		function addElement() {
			var cbCount = document.getElementsByClassName("conf_block").length;
			var puId = "cb_" + cbCount+1;

			var newdiv = document.createElement("div");
			newdiv.className = "conf_block";
			
			var newAV = document.createElement("div");
			newAV.className = "always_visible";
			newAV.append("Test");
			newAV.onclick = function() { on_conf_click(puId); };

			var newPU = document.createElement("div");
			newPU.className = "popup";
			newPU.id = puId;
			newPU.append("test<br>test<br>test");

			newdiv.append(newAV);
			newdiv.append(newPU);

			document.getElementsByClassName("all_red_info")[0].append(newdiv);

		}
	</script>