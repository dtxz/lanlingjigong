	<link rel="stylesheet" href="/include/kindeditor/themes/default/default.css" />
	<link rel="stylesheet" href="/include/kindeditor/plugins/code/prettify.css" />
	<script charset="utf-8" src="/include/kindeditor/kindeditor.js"></script>
	<script charset="utf-8" src="/include/kindeditor/lang/zh_CN.js"></script>
	<script charset="utf-8" src="/include/kindeditor/plugins/code/prettify.js"></script>
	<script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="content"]', {
				cssPath : '/include/kindeditor/plugins/code/prettify.css',
				uploadJson : '/include/kindeditor/php/upload_json.php',
				fileManagerJson : '/include/kindeditor/php/file_manager_json.php',
				allowFileManager : true,
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=zzcms]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=zzcms]')[0].submit();
					});
				}
			});
			prettyPrint();
		});
	</script>