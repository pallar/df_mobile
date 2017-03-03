// jsql.js
// sql via javascript
function jsql(query){
	var res=0, table_cols=0;
	if(/SELECT/i.test(query)){var c=query.split("FROM"),table_cols=c[0].split(",").length;}
	jQuery.ajax({async:false,data:{query:query,table_cols:table_cols},dataType:"json",url:"../dflib/ajax/jsql.php",success:function(data){res=data;},type:"post"});return res;
}
