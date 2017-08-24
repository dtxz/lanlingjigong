var submitFlg = false;
var mustText = "（必选）";
function onLoad() {
	writeInitValue();
}

//每次进入窗口后，取出userList中的全体功能，将这些功能移到右面的已选功能中
function writeInitValue() {
	if (document.all.otherList.value != "") {
		var str = document.all.actForm.otherList.value;
		var ary = str.split(";");
		for (var k=0; k<ary.length; k++) {
			var count = document.all.selectStuff.options.length;
			for (var i=0; i<document.all.selectStuff.options.length; i++) {
				if (ary[k] == document.all.selectStuff.options[i].value) {
					document.all.actForm.selectStuff.remove(i);
					break;
				}
			}
		}
	}
	if (document.all.mustSelect.value != "") {
		var str = document.all.actForm.mustSelect.value;
		var ary = str.split(";");
		for (var k=0; k<ary.length; k++) {
			var count = document.all.selectStuff.options.length;
			for (var i=0; i<document.all.selectStuff.options.length; i++) {
				if (ary[k] == document.all.selectStuff.options[i].value) {
					initMove(i, document.all.mustText.value);
					break;
				}
			}
		}
		document.all.mustSelect.value = "";
	}
	if (document.all.userList.value != "") {
		var str = document.all.actForm.userList.value;
		var ary = str.split(";");
		for (var k=0; k<ary.length; k++) {
			var count = document.all.selectStuff.options.length;
			for (var i=0; i<document.all.selectStuff.options.length; i++) {
				if (ary[k] == document.all.selectStuff.options[i].value) {
					initMove(i, "");
					break;
				}
			}
		}
		document.all.userList.value = "";
	}
}

function initMove(i, appendText) {
	var s = document.all.actForm.selectStuff;
	var t = document.all.actForm.selectToStuff;
	var nIndex = i;
	var eItem;
	if (nIndex < 0) return;
	eItem = document.createElement ("OPTION");
	t.add (eItem);
	eItem.innerText = s.item (nIndex).text;
	eItem.value = s.item (nIndex).value;
	if (appendText != "") {
		eItem.innerText += appendText;
		eItem.style.color = "red";
	}
	s.remove (nIndex);
}

//设置必选
function setMust() {
	var i = document.all.selectToStuff.selectedIndex;
	if (i == -1) return;
	var selectedOption = document.all.selectToStuff.options[i];
	if (selectedOption.text.indexOf(document.all.mustText.value) > -1) return;
	selectedOption.innerText += document.all.mustText.value;
	selectedOption.style.color = "red";
}

//取消必选
function cancelMust() {
	var i = document.all.selectToStuff.selectedIndex;
	if (i == -1) return;
	var selectedOption = document.all.selectToStuff.options[i];
	var indexSite = selectedOption.text.indexOf(document.all.mustText.value);
	if (indexSite == -1) return;
	selectedOption.innerText = selectedOption.text.substring(0, indexSite);
	selectedOption.style.color = "#000";
}


//设置必选
function setMust2() {
	var i = document.all.selectToStuff2.selectedIndex;
	if (i == -1) return;
	var selectedOption = document.all.selectToStuff2.options[i];
	if (selectedOption.text.indexOf(document.all.mustText.value) > -1) return;
	selectedOption.innerText += document.all.mustText.value;
	selectedOption.style.color = "red";
}

//取消必选
function cancelMust2() {
	var i = document.all.selectToStuff2.selectedIndex;
	if (i == -1) return;
	var selectedOption = document.all.selectToStuff2.options[i];
	var indexSite = selectedOption.text.indexOf(document.all.mustText.value);
	if (indexSite == -1) return;
	selectedOption.innerText = selectedOption.text.substring(0, indexSite);
	selectedOption.style.color = "#000";
}

//写入
function writeReceiver(linkFun) {
	var str="";
	for (var i=0; i<document.all.selectToStuff.options.length; i++) {
		str += document.all.selectToStuff.options[i].value + ";";
	}
	document.all.actForm.userList.value = str;
	str="";
	for (var i=0; i<document.all.selectToStuff.options.length; i++) {
		if (document.all.selectToStuff.options[i].text.indexOf(document.all.mustText.value) > -1) {
			str += document.all.selectToStuff.options[i].value + ";";
		}
	}
	document.all.actForm.mustSelect.value = str;
	submitButton(linkFun);
}



//移动选中功能
//nType = 0: 左边选中的一个移到右边
//nType = 1: 右边选中的一个移到左边
//nType = 2: 左边全部移到右边
//nType = 3: 右边全部移到左边
function UserMove (nType)
{
    if (nType == 0 && document.all.selectStuff.selectedIndex < 0)
        return;
    if (nType == 1 && document.all.selectToStuff.selectedIndex < 0)
        return;

    if (nType == 0) {
            OrtSelectMove (document.all.selectStuff, document.all.selectToStuff, 0);
    } else if (nType == 1) {
            OrtSelectMove (document.all.selectToStuff, document.all.selectStuff, 0);
    } else if (nType == 2) {
            OrtSelectMoveAll (document.all.selectStuff, document.all.selectToStuff, 0);
    } else {
            OrtSelectMoveAll (document.all.selectToStuff, document.all.selectStuff, 0);
    }
}

//移动选中功能
//nType = 0: 左边选中的一个移到右边
//nType = 1: 右边选中的一个移到左边
//nType = 2: 左边全部移到右边
//nType = 3: 右边全部移到左边
function UserMove2 (nType)
{
    if (nType == 0 && document.all.selectStuff.selectedIndex < 0)
        return;
    if (nType == 1 && document.all.selectToStuff2.selectedIndex < 0)
        return;

    if (nType == 0) {
            OrtSelectMove (document.all.selectStuff, document.all.selectToStuff2, 0);
    } else if (nType == 1) {
            OrtSelectMove (document.all.selectToStuff2, document.all.selectStuff, 0);
    } else if (nType == 2) {
            OrtSelectMoveAll (document.all.selectStuff, document.all.selectToStuff2, 0);
    } else {
            OrtSelectMoveAll (document.all.selectToStuff2, document.all.selectStuff, 0);
    }
}
//将选中的一个进行移动
function OrtSelectMove (Source, Target, Start)
{
    var nIndex;
    var eItem;
    if (Start < 0)
        Start = 0;
    nIndex = Source.selectedIndex;
    if (nIndex < Start) return;
    if (Source.options[nIndex].text.indexOf(mustText) > -1) {
    	alert("此项操作为必选项，不可移动");
    	return;
    }
    if (Target != null)
    {
        eItem = document.createElement ("OPTION");
        Target.add (eItem);
        eItem.innerText = Source.item (nIndex).text;
        eItem.value = Source.item (nIndex).value;
        Target.selectedIndex = Target.length - 1;
    }
    Source.remove (nIndex);
    if (nIndex >= Source.length)
        nIndex = Source.length - 1;
    Source.selectedIndex = nIndex;
}

//将所有的进行移动
function OrtSelectMoveAll (Source, Target, Start)
{
    var eItem;
    if (Start < 0)
        Start = 0;
    if (Source.length < Start)
        return;
    while (Source.length > Start)
    {
        if (Target != null)
        {
        	if (Source.item (Start).text.indexOf(mustText) > -1) {
        		Start ++;
        		continue;
        	}
            eItem = document.createElement ("OPTION");
            Target.add (eItem);
            eItem.innerText = Source.item (Start).text;
            eItem.value = Source.item (Start).value;
        }
        Source.remove (Start);
    }
    Source.selectedIndex = -1;
    if (Target != null)
        Target.selectedIndex = Target.length - 1;
}
