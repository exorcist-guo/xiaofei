import{W as o,y as a,X as t,A as e,x as n,B as l}from"./index-BRXUfIsq.js";let i="http://q.queryagency.com",s={};const d=({data:d={},method:c="get",url:r="",noLogin:g=!1,type:u=1,showToast:m=!1,returnUrl:p=!1})=>new Promise(((h,f)=>{var y,$;p&&(console.log(i,r,u,i),h(`${i}/api/${r}`)),s[r]?(e({noConflict:!0}),console.log(r),f("请求次数频繁",r)):(s[r]=!0,o({url:`${i}/api/${r}`,data:d,method:c,header:{"content-type":"application/json",Authorization:"Bearer "+a("token"),language:(null==($=null==(y=a("locale"))?void 0:y.language)?void 0:$.id)||t()},success:o=>{setTimeout((()=>{s[r]=!1,e({noConflict:!0})}),250),0==o.data.code?h(o.data):40001==o.data.code?g?h({code:40001,data:[]}):(f({code:40001,msg:o.data.msg}),n({url:"/pages/login/login"})):(m&&l({title:o.data.msg,icon:"none"}),f({...o.data}))},fail:o=>{setTimeout((()=>{e({noConflict:!0}),s[r]=!1}),250),m||l({title:"网络连接超时",icon:"none"}),f(o)}}))}));export{d as a};
