import{X as a,y as e,Y as o,A as t,x as n,B as l,Z as i}from"./index-DZskOWDi.js";let s="http://q.queryagency.com",d={};const r=({data:i={},method:r="get",url:c="",noLogin:u=!1,type:g=1,showToast:m=!1,returnUrl:p=!1})=>new Promise(((h,f)=>{var v,y;p&&(console.log(s,c,g,s),h(`${s}/api/${c}`)),d[c]?(t({noConflict:!0}),console.log(c),f("请求次数频繁",c)):(d[c]=!0,a({url:`${s}/api/${c}`,data:i,method:r,header:{"content-type":"application/json",Authorization:"Bearer "+e("token"),language:(null==(y=null==(v=e("locale"))?void 0:v.language)?void 0:y.id)||o()},success:a=>{setTimeout((()=>{d[c]=!1,t({noConflict:!0})}),250),0==a.data.code?h(a.data):40001==a.data.code?u?h({code:40001,data:[]}):(f({code:40001,msg:a.data.msg}),n({url:"/pages/login/login"})):(m&&l({title:a.data.msg,icon:"none"}),f({...a.data}))},fail:a=>{setTimeout((()=>{t({noConflict:!0}),d[c]=!1}),250),m||l({title:"网络连接超时",icon:"none"}),f(a)}}))})),c=a=>new Promise(((t,n)=>{var l,d;i({url:`${s}/api/upload/image`,method:"post",formData:{},name:"base64",filePath:a,header:{Authorization:"Bearer "+e("token"),language:(null==(d=null==(l=e("locale"))?void 0:l.language)?void 0:d.id)||o()},success:a=>{let e=JSON.parse(a.data);t(e)}})}));export{r as a,c as u};
