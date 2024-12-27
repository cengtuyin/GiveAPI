<!doctype html>
<html class="mdui-theme-auto">

<head>
    <meta charset="utf-8">
    <title>GiveAPI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
    <meta name="renderer" content="webkit" />
    <link rel="stylesheet" href="./Web/css/mdui.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="./Web/js/mdui.global.js"></script>
    <script type="text/javascript" src="./Web/js/md5.js"></script>

    <style>
        .h1 {
            line-height: var(--mdui-typescale-headline-large-line-height);
            font-size: var(--mdui-typescale-headline-large-size);
            letter-spacing: var(--mdui-typescale-headline-large-tracking);
            font-weight: var(--mdui-typescale-headline-large-weight);
        }
        .h3 {
            line-height: var(--mdui-typescale-body-large-line-height);
            font-size: var(--mdui-typescale-body-large-size);
            letter-spacing: var(--mdui-typescale-body-large-tracking);
            font-weight: var(--mdui-typescale-body-large-weight);
        }
        .h5 {
            line-height: var(--mdui-typescale-headline-small-line-height);
            font-size: var(--mdui-typescale-headline-small-line-size);
            letter-spacing: var(--mdui-typescale-headline-small-line-tracking);
            font-weight: var(--mdui-typescale-headline-small-line-weight);
        }
    </style>
</head>

<body style="margin:0;height:100vh;">
    <mdui-layout style="min-height:100vh;">
        <mdui-top-app-bar variant="small" scroll-behavior="elevate" class="example-top-app-bar">
            <mdui-linear-progress id="loadingview" style="display:none;position: fixed;top: 0;left:0;z-index:999;width:100vw;height:0.2em;"></mdui-linear-progress>
            <mdui-button-icon icon="menu" id="openmenu"></mdui-button-icon>
            <mdui-top-app-bar-title>GiveAPI</mdui-top-app-bar-title>
            <div style="flex-grow: 1"></div>
            <mdui-button-icon icon="more_vert"></mdui-button-icon>
        </mdui-top-app-bar>
        <mdui-navigation-drawer id="MainList" style="min-height:100vh;" close-on-overlay-click modal="false" class="example-navigation-drawer" contained>
            <mdui-list style="overflow-y: auto;">
                <mdui-collapse accordion>
                    <mdui-list-item icon="home" onclick="LoadMainUI('../html/main/index.html');">官网</mdui-list-item>
                    <mdui-list-item icon="shop" onclick="LoadMainUI('../html/main/AppStore.html');">应用商店</mdui-list-item>
                    <mdui-collapse-item>
                        <mdui-list-item slot="header" icon="cloud" end-icon="arrow_right">云服务</mdui-list-item>
                        <div style="margin-left: 2.5rem">
                            <mdui-list-item icon="speaker_notes" onclick="LoadMainUI('../html/main/login.html');">即时通知</mdui-list-item>
                            <mdui-list-item icon="location_on" onclick="LoadMainUI('../html/main/Instantpositioning.html');">即时定位</mdui-list-item>
                            <mdui-list-item icon="folder" onclick="NotOpenPrompt();">云盘</mdui-list-item>
                            <mdui-list-item icon="photo_size_select_actual" onclick="NotOpenPrompt();">相册</mdui-list-item>
                            <mdui-list-item icon="text_snippet" onclick="NotOpenPrompt();">笔记</mdui-list-item>
                            <mdui-list-item icon="graphic_eq" onclick="NotOpenPrompt();">录音</mdui-list-item>
                        </div>
                    </mdui-collapse-item>
                    <mdui-collapse-item>
                        <mdui-list-item slot="header" icon="download" end-icon="arrow_right">下载</mdui-list-item>
                        <div style="margin-left: 2.5rem">
                            <mdui-list-item icon="watch" onclick="LoadMainUI('../html/main/watchospro.html');">WatchOSPro</mdui-list-item>
                            <mdui-list-item icon="phone_android" onclick="LoadMainUI('../html/main/mywatchospro.html');">MyWatchOSPro</mdui-list-item>
                            <mdui-list-item icon="web" onclick="NotOpenPrompt();">页面合集</mdui-list-item>
                            <mdui-list-item icon="settings" onclick="NotOpenPrompt();">插件</mdui-list-item>
                        </div>
                    </mdui-collapse-item>
                    <mdui-collapse-item>
                        <mdui-list-item slot="header" icon="near_me" end-icon="arrow_right">开始使用</mdui-list-item>
                        <div style="margin-left: 2.5rem">
                            <mdui-list-item onclick="NotOpenPrompt();">1. 下载原神</mdui-list-item>
                        </div>
                    </mdui-collapse-item>
                    <mdui-collapse-item>
                        <mdui-list-item slot="header" icon="help" end-icon="arrow_right">常见问题</mdui-list-item>
                        <div style="margin-left: 2.5rem">
                            <mdui-list-item onclick="LoadMainUI('../html/main/QA/1.html');">无法连接到服务器</mdui-list-item>
                            <mdui-list-item onclick="NotOpenPrompt();">无法打开原神</mdui-list-item>
                        </div>
                    </mdui-collapse-item>
                    <mdui-list-item icon="info" onclick="LoadMainUI('../html/main/about.html');">关于</mdui-list-item>
                </mdui-collapse>
            </mdui-list>
        </mdui-navigation-drawer>
        <mdui-layout-main id="main" class="example-layout-main" style="min-height: 300px;">
        
        </mdui-layout-main>
    </mdui-layout>

    <script type="text/javascript">
        var navigationDrawerState = false;
        const navigationDrawer = document.getElementById("MainList");
        if(mdui.breakpoint().up('md')){
            navigationDrawerState = true;
            navigationDrawer.open = navigationDrawerState;
        }
        document.getElementById("openmenu").addEventListener("click", function(){
            if(navigationDrawerState){
                navigationDrawerState = false;
            }else{
                navigationDrawerState = true;
            }
            navigationDrawer.open = navigationDrawerState;
        });
        navigationDrawer.addEventListener("close", function(){
            navigationDrawerState = false;
        });
        navigationDrawer.addEventListener("open", function(){
            navigationDrawerState = true;
        });
        var codejstemp;
        function LoadMainUI(url,type=""){
            if(mdui.breakpoint().down('md')){
                navigationDrawerState = false;
                navigationDrawer.open = navigationDrawerState;
            }
            try{
                CloseJS(codejstemp);
            }catch(err){

            }
            document.getElementById("loadingview").style.display="block";
            setTimeout(() => {
            var httpRequest = new XMLHttpRequest();
            httpRequest.open('GET', url, true);
            httpRequest.send();
            httpRequest.onreadystatechange = function () {
                if (httpRequest.readyState == 4 && httpRequest.status == 200) {
                    const ui=httpRequest.responseText;
                    if(ui=="404 Error"){
                        ui="页面不存在";
                    }
                    document.getElementById("main").innerHTML=ui;
                    codejstemp=LoadJS();
                }else if(httpRequest.readyState == 4){
                    document.getElementById("main").innerHTML="请求异常，无法加载界面";
                    //snackbar({message: "请求错误，请稍候重试",closeOnOutsideClick: true,autoCloseDelay: 1500});
                }
                switch (type) {
                    case "OFF":
                        break;
                    default:
                        document.getElementById("loadingview").style.display="none";
                        break;
                }
            };
            }, 0);
        }
        function CloseLoadUILoadview(){
            document.getElementById("loadingview").style.display="none";
        }
        function LoadJS() {
            var parentElement = document.getElementById("main");
            var scriptElements = parentElement.getElementsByTagName("script");
            var scriptContents = [];
            for (var i = 0; i < scriptElements.length; i++) {
                var scriptElement = scriptElements[i];
                var content;
                if (scriptElement.src) {
                    content = scriptElement.src;
                } else {
                    content = scriptElement.textContent || scriptElement.innerHTML;
                }
                var scriptElement = document.createElement("script");
                if (typeof content === "string" && content.startsWith("http://") || content.startsWith("https://")) {
                    scriptElement.src = content;
                } else {
                    scriptElement.textContent = content;
                }
                document.body.appendChild(scriptElement);
                scriptContents.push(scriptElement);
            }
            return scriptContents;
        }
        function CloseJS(jslist) {
            jslist.forEach((scriptElement)=> {
                if (scriptElement && scriptElement.parentNode) {
                    scriptElement.parentNode.removeChild(scriptElement);
                }
            });
        }
        
        function NotOpenPrompt(){
            mdui.snackbar({
                message: "前面的区域以后再来探索吧～？"
            });
        }


        LoadMainUI("../html/main/watchospro.html");
    </script>
</body>

</html>