import{H as o,y as t,u as a,p as e,v as n}from"./index-3df494fb.js";let s="http://integraltest.queryping.com",i={};const c=({data:c={},method:l="get",url:r="",noLogin:d=!1,type:p=1,showToast:g=!1,returnUrl:m=!1})=>new Promise(((u,f)=>{m&&(console.log(s,r,p,s),u(`${s}/api/${r}`)),i[r]?(a({noConflict:!0}),console.log(r),f("请求次数频繁",r)):(i[r]=!0,o({url:`${s}/api/${r}`,data:c,method:l,header:{"content-type":"application/json",Authorization:"Bearer "+t("token")},success:o=>{setTimeout((()=>{i[r]=!1,a({noConflict:!0})}),250),0==o.data.code?u(o.data):40001==o.data.code?d?u({code:40001,data:[]}):(f({code:40001,msg:o.data.msg}),e({url:"/pages/login/login"})):(g&&n({title:o.data.msg,icon:"none"}),f({...o.data}))},fail:o=>{setTimeout((()=>{a({noConflict:!0}),i[r]=!1}),250),g||n({title:"网络连接超时",icon:"none"}),f(o)}}))})),l=(o,t)=>{const a=o.__vccOpts||o;for(const[e,n]of t)a[e]=n;return a};export{l as _,c as a};
