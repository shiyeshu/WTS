/**
 * 模仿ACFUN通知条
 * @authors 野兔 (admin@azimiao.com)
 * @date    2017-10-20 10:43:00
 * @modify  2018-08-20 10:00:00
 * @version 0.1.3
 */

var zi_notify = zi_notify || {};

zi_notify.ENotifyType = {
    nomal:-1,
    main:0,
    warning:1,
    cute:2,
    heavy:3
};

zi_notify.colorData = {

        fontColor : "#FBFBFF",
	    mainColor : "#ff8c83",
        borderColor : "#fa8072"
    
};





//showNotify function code by qwq.moe 
zi_notify.showNotify = function(messageType = -1,messageContent = null){
    if(zi_notify.checkUserUA()){
        return;
    }
    if(document.querySelector('.notify-container') == null){
        var notify_container = new DOMParser().parseFromString('<div class="notify-container"></div>',"text/html").querySelector(".notify-container");
        document.body.insertBefore(notify_container,document.body.children[0]);
    }

    var ne = zi_notify.getContentDOM(messageType,messageContent);
    if(ne.length != 0){
        document.querySelector('.notify-container').appendChild(ne);
        setTimeout(function(){ne.remove()},4500);
    }
};

zi_notify.checkUserUA = function() {
    
};

zi_notify.getContentDOM = function(messageType,messageContent){

    var colorTemp;

    switch(messageType){
        case "":case "undefined":case undefined :case null:case zi_notify.ENotifyType.nomal:
		{
            colorTemp = zi_notify.colorData.green;
			break;
        }
        case zi_notify.ENotifyType.heavy:
        {
            colorTemp = zi_notify.colorData.blue;
            break;
        }
        case zi_notify.ENotifyType.cute:
        {
            colorTemp = zi_notify.colorData.pink;
            break;

        }
        case zi_notify.ENotifyType.warning:
        {
            colorTemp = zi_notify.colorData.red;
            break;

        }
        case zi_notify.ENotifyType.main:
        {
            colorTemp = zi_notify.colorData.main;
            break;
        }
    }

    domStr = '<div class="notify" style="background-color: '+ zi_notify.colorData.mainColor + ';border-left: 7px solid '+ zi_notify.colorData.borderColor +';color: white;"><div class="title">'+ messageContent.title +'</div><div class="content" style= "color: '+ zi_notify.colorData.fontColor +';">'+ messageContent.content +'</div></div>';
    contentDom = new DOMParser().parseFromString(domStr,"text/html").querySelector(".notify");
    return contentDom;
};



