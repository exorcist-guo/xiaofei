import{X as a,y as o,Y as e,A as t,x as n,B as l,Z as i}from"./index-Cu6ZRL8P.js";let s="http://www.xiao.xyz",d={};const r=({data:i={},method:r="get",url:u="",noLogin:c=!1,type:g=1,showToast:m=!1,returnUrl:p=!1})=>new Promise(((h,f)=>{var v,w;p&&(console.log(s,u,g,s),h(`${s}/api/${u}`)),d[u]?(t({noConflict:!0}),console.log(u),f("请求次数频繁",u)):(d[u]=!0,a({url:`${s}/api/${u}`,data:i,method:r,header:{"content-type":"application/json",Authorization:"Bearer "+o("token"),language:(null==(w=null==(v=o("locale"))?void 0:v.language)?void 0:w.id)||e()},success:a=>{setTimeout((()=>{d[u]=!1,t({noConflict:!0})}),250),0==a.data.code?h(a.data):40001==a.data.code?c?h({code:40001,data:[]}):(f({code:40001,msg:a.data.msg}),n({url:"/pages/login/login"})):(m&&l({title:a.data.msg,icon:"none"}),f({...a.data}))},fail:a=>{setTimeout((()=>{t({noConflict:!0}),d[u]=!1}),250),m||l({title:"网络连接超时",icon:"none"}),f(a)}}))})),u=a=>new Promise(((t,n)=>{var l,d;i({url:`${s}/api/upload/image`,method:"post",formData:{},name:"base64",filePath:a,header:{Authorization:"Bearer "+o("token"),language:(null==(d=null==(l=o("locale"))?void 0:l.language)?void 0:d.id)||e()},success:a=>{let o=JSON.parse(a.data);t(o)}})}));export{r as a,u};
