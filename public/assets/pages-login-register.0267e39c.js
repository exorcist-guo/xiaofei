import{p as e,r as a,o as l,q as t,u as s,a as o,c as n,w as c,i as r,b as i,g as u,j as d,t as m,v as p,k as f,m as g,f as _,I as x,S as h}from"./index-48b86b6b.js";import{_ as v,a as w}from"./show.5b38c7ba.js";import{o as y,a as b}from"./uni-app.es.05e9ff15.js";import{c as V,v as k,r as j,i as U}from"./user.e1c28645.js";import{_ as I}from"./_plugin-vue_export-helper.1b428a4d.js";import"./request.f7e270e6.js";const C=I({__name:"register",setup(I){const C=e(!1),P=e(0),T=a({mobile:"",invite_mobile:"",verify:"",password:"",realPassword:"",captcha:""}),q=e({img:"",key:""});y((e=>{e.code&&(T.invite_mobile=e.code)})),l((()=>{S()}));const F=async()=>{if(11!==T.mobile.trim().length)return p({title:"请输入正确的手机号",icon:"none"}),!1;if(!T.captcha)return p({title:"请输入正确的算式结果",icon:"none"}),!1;try{const{data:e}=await k({mobile:T.mobile,key:q.value.key,type:"register",captcha:T.captcha});p({title:"验证码发送成功",icon:"none"}),C.value=!0,P.value=60,globalThis.inter=setInterval((()=>{P.value-=1,0==P.value&&(clearInterval(globalThis.inter),C.value=!1)}),1e3)}catch(e){setTimeout((()=>{S()}),1e3)}};b((()=>{clearInterval(globalThis.inter)}));const N=async()=>{if(T.password!=T.realPassword)return p({title:"两次密码输入不匹配",icon:"none"}),!1;if(0==T.invite_mobile.length)return p({title:"请输入",icon:"none"}),!1;const e={mobile:T.mobile,invite_mobile:T.invite_mobile,password:T.password,verify:T.captcha};console.log(e),await j(e);const a=await U();f("userInfo",a.data),g({url:"/pages/login/realName"})},S=()=>{t({mask:!0}),V({type:"register",mobile:T.mobile}).then((({data:e})=>{q.value=e.url,s()}))};return(e,a)=>{const l=r,t=_,s=x,p=h;return o(),n(l,{class:"page flex-column-center-center"},{default:c((()=>[i(p,{"scroll-y":"",class:"scroll"},{default:c((()=>[i(l,{class:"title"},{default:c((()=>[u("注册")])),_:1}),d("",!0),i(l,{class:"input-area flex-start-center-nowrap"},{default:c((()=>[i(l,{class:"icon"},{default:c((()=>[i(t,{class:"image",src:v})])),_:1}),i(s,{name:"account",modelValue:T.invite_mobile,"onUpdate:modelValue":a[1]||(a[1]=e=>T.invite_mobile=e),class:"input flex-1",type:"text",placeholder:"推荐人"},null,8,["modelValue"])])),_:1}),i(l,{class:"input-area flex-start-center-nowrap"},{default:c((()=>[i(l,{class:"icon"},{default:c((()=>[i(t,{class:"image",src:v})])),_:1}),i(s,{name:"account",class:"input flex-1",modelValue:T.mobile,"onUpdate:modelValue":a[2]||(a[2]=e=>T.mobile=e),type:"text",maxlength:"11",placeholder:"手机号"},null,8,["modelValue"])])),_:1}),i(l,{class:"input-area flex-start-center-nowrap"},{default:c((()=>[i(l,{class:"icon"},{default:c((()=>[i(t,{class:"image",src:v})])),_:1}),i(s,{name:"account",modelValue:T.verify,"onUpdate:modelValue":a[3]||(a[3]=e=>T.verify=e),class:"input flex-1",type:"text",maxlength:"11",placeholder:"请输入验证码"},null,8,["modelValue"]),C.value?(o(),n(l,{key:1,class:"get-code get"},{default:c((()=>[u(m(P.value)+"s",1)])),_:1})):(o(),n(l,{key:0,class:"get-code gray",onClick:F},{default:c((()=>[u("获取验证码")])),_:1}))])),_:1}),i(l,{class:"flex-start-center-nowrap"},{default:c((()=>[i(l,{class:"input-area flex-start-center-nowrap",style:{width:"384rpx"}},{default:c((()=>[i(s,{name:"account",modelValue:T.captcha,"onUpdate:modelValue":a[4]||(a[4]=e=>T.captcha=e),class:"input flex-1",type:"text",maxlength:"11",placeholder:"请输入图中算式结果"},null,8,["modelValue"])])),_:1}),i(t,{class:"verify",mode:"widthFix",src:q.value.img,onClick:S},null,8,["src"])])),_:1}),i(l,{class:"input-area flex-start-center-nowrap"},{default:c((()=>[i(l,{class:"icon"},{default:c((()=>[i(t,{class:"image",src:v})])),_:1}),i(s,{name:"account",modelValue:T.password,"onUpdate:modelValue":a[5]||(a[5]=e=>T.password=e),class:"input flex-1",type:"text",maxlength:"11",placeholder:"输入您的密码"},null,8,["modelValue"]),i(l,{class:"icon"},{default:c((()=>[i(t,{class:"image",src:w})])),_:1})])),_:1}),i(l,{class:"input-area flex-start-center-nowrap"},{default:c((()=>[i(l,{class:"icon"},{default:c((()=>[i(t,{class:"image",src:v})])),_:1}),i(s,{name:"account",modelValue:T.realPassword,"onUpdate:modelValue":a[6]||(a[6]=e=>T.realPassword=e),class:"input flex-1",type:"text",maxlength:"11",placeholder:"输入您的密码"},null,8,["modelValue"]),i(l,{class:"icon"},{default:c((()=>[i(t,{class:"image",src:w})])),_:1})])),_:1}),i(l,{class:"btn",onClick:N},{default:c((()=>[u("提交")])),_:1}),i(l,{class:"btn line flex-center-center",onClick:a[7]||(a[7]=a=>e.toUrl("/pages/login/login"))},{default:c((()=>[u("手机号登录")])),_:1})])),_:1})])),_:1})}}},[["__scopeId","data-v-d7161f69"]]);export{C as default};
