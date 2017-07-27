<?php

?>

<script>
		var jumlah_disposisi=0;
		var id_div_a;
		id_div_a="tbl_berita_komentar_0";
		
			function tambah_baris_komentar(komen)
			{
				var obj_table;								
				var newRow1=document.getElementById(id_div_a);
				var parinte = newRow1.parentNode;				  
				var newRow0 = document.createElement("TR");				
				var newTable = document.createElement("TABLE");
				var newRow = document.createElement("TR");
				var newCol = document.createElement("TD");

				var newTxt2 = document.createTextNode("");
				var newTxt = document.createTextNode("");
				var id_div;
				var obj_field;
				var nm_table;
				var cond;
				var sql;
				var f;
				jumlah_disposisi++;
				id_div="dis_r_k_"+jumlah_disposisi;
				newTable.setAttribute('border','1');
				id_div="dis_r_k_"+jumlah_disposisi;	
				id_div_a=id_div;				
				newCol.innerHTML='<div id="div_komen_isi_'+jumlah_disposisi+'"></div>';				
				id_div="dis_col_c_"+jumlah_disposisi;	
				newCol.setAttribute('id',id_div);
				newCol.appendChild(newTxt);
				newRow.appendChild(newCol);
				newRow.setAttribute('id',id_div_a);
				parinte.insertBefore(newRow, newRow1);
				return id_div_a;
			}

</script>
