import{_ as e,u as a,r as l,f as t,y as s,p as o,z as i,A as n,a as r,w as c,i as u,o as d,b as p,d as m,t as g,B as A,q as f,x as h,k as v,I as w,S as x}from"./index-BRXUfIsq.js";import{_ as b,a as y,b as V}from"./show.B0O9Pu_2.js";import{a as _,o as U,b as I}from"./uni-app.es.DDCqBda2.js";import{c as R,v as k,r as M,i as B}from"./user.Bg5HKHUN.js";import"./request.DZBRZmUR.js";const E=e({__name:"register",setup(e){const{t:E}=a(),j=l(!1),D=l(0),J=t({nick_name:"",mobile:"",invite_mobile:"",verify:"",password:"",realPassword:"",captcha:"",name:"",nation:""}),Q=l(!1),C=l(!1),K=l({img:"",key:""});_((e=>{s("invite_mobile")&&(J.invite_mobile=s("invite_mobile"))})),o((()=>{O()})),U((()=>{console.log(D.value)}));const N=async()=>{if(console.log(E("login.register.regMobile")),!J.mobile.match(/^[A-Za-z0-9\u4e00-\u9fa5]+@[a-zA-Z0-9_-]+(.[a-zA-Z0-9_-]+)+$/))return A({title:E("login.register.regMobile"),icon:"none"}),!1;if(!J.captcha)return A({title:E("login.register.regCaptcha"),icon:"none"}),!1;try{const{data:e}=await k({mobile:J.mobile,key:K.value.key,type:"register",captcha:J.captcha});A({title:E("login.register.sendSucess"),icon:"none"}),j.value=!0,D.value=60,globalThis.inter=setInterval((()=>{D.value-=1,0==D.value&&(clearInterval(globalThis.inter),j.value=!1)}),1e3)}catch(e){setTimeout((()=>{O()}),1e3)}};I((()=>{clearInterval(globalThis.inter)}));const Z=async()=>{let e={},a=Object.keys(s("localeList").nation),l=Object.values(s("localeList").nation);for(let s in a)e[l[s]]=a[s];let t=e[s("locale").country];if(console.log("国家id:",t),J.password!=J.realPassword)return A({title:E("login.register.faillPass"),icon:"none"}),!1;if(0==J.invite_mobile.length)return A({title:E("login.register.pelaseInput"),icon:"none"}),!1;const o={mobile:J.mobile,invite_mobile:J.invite_mobile,password:J.password,verify:J.captcha,nation:t,name:J.nick_name};console.log(o),await M(o);const i=await B();f("userInfo",i.data),h({url:"/pages/login/realName"})},O=()=>{i({mask:!0}),R({type:"register",mobile:J.mobile}).then((({data:e})=>{K.value=e.url,n()}))};return(e,a)=>{const l=u,t=v,s=w,o=x;return d(),r(l,{class:"page flex-column-center-center"},{default:c((()=>[p(o,{"scroll-y":"",class:"scroll"},{default:c((()=>[p(l,{class:"title"},{default:c((()=>[m(g(e.$t("login.register.title")),1)])),_:1}),p(l,{class:"input-area flex-start-center-nowrap"},{default:c((()=>[p(l,{class:"icon"},{default:c((()=>[p(t,{class:"image",src:b})])),_:1}),p(s,{name:"account",modelValue:J.invite_mobile,"onUpdate:modelValue":a[0]||(a[0]=e=>J.invite_mobile=e),class:"input flex-1",type:"text",placeholder:e.$t("login.register.invite_mobile")},null,8,["modelValue","placeholder"])])),_:1}),p(l,{class:"input-area flex-start-center-nowrap"},{default:c((()=>[p(l,{class:"icon"},{default:c((()=>[p(t,{class:"image",src:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAAXNSR0IArs4c6QAAARZJREFUOE9jZKAyYMRmnqKYcBwTE1P1////VRgZGZmQ1fz///8fIyPjnX///rXef/V2Ebp+DAOVxESiGZkYl/xnYDjMwPB/PwMDwz80TUwMDIyOjAwMtv///Y+59+rNUmR5DAOVxUWuMjAwfrz78rUNFsNgepmUxUWPMDD857/78o02IQN//2NkaL//4k0dvuBVlBBpYvrPUHn35RtW/AZKiP7/z/C/4d6LN434DFSSEKlnZGBsuPviNYovMb08aiCucBwNQ3jIDEyyURAX9gc54cHLtxthTiE+UsRFULKeHD+/IAsH6xuQQX9+/BZ59PHjexCb+KyHpXBQEhfpAxly7+WbIqgLiS8cqF58gb1DzQKW0hoBAFga5BVvOK3rAAAAAElFTkSuQmCC"})])),_:1}),p(s,{name:"account",class:"input flex-1",modelValue:J.mobile,"onUpdate:modelValue":a[1]||(a[1]=e=>J.mobile=e),type:"text",placeholder:e.$t("login.register.mobile")},null,8,["modelValue","placeholder"])])),_:1}),p(l,{class:"input-area flex-start-center-nowrap"},{default:c((()=>[p(l,{class:"icon"},{default:c((()=>[p(t,{class:"image",src:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAAXNSR0IArs4c6QAAAgpJREFUOE+V1EuozVEUBvDfVR4ZGJBXooxk4pm8KZSUEgYyMSIiI6XI9BKFUoTMDDBhQpJHorxKRJKR5P0ciIHksZfWuZ1z7vmfc+3JOe3/t7/9rW99e3Xp2+qfsJ+d4F2dAFiAo4nbhBvtzlQRhqKl2IIlOI3ArsEVHMYl9FJcTxhKpmFOUbEIQ3Ae+3AnVc3CdizHV1wtF9/GfdwMTI1wBN7iVQJCRZC9qyhvVJKG+tkYW2yJvQ81wlDzEaHgQR98rYdMwd1iw/BQXSOM3yhhFS7/J2GoPJcW/an38BGOpeHtOJdhb5b6PRu3EZPqPYz/Z/C5+LC5Ddt8XMT1Ys0K/MIRDMsE9DQlOLZhXZE/GQNwMMFP8oKpJZPX8Cyj9C33H+Ik9jcrnJ4dHpd+3isWjMZqvMlARwUL8SnJRuJllh/RaVDYD8/RjeMYWnw5W0qciS/4XUI9Dy/qLNmAXRif3xsIAxdmR6hn5KFBOJGvJvYfN/kbVYSfEfZ/q/npxU1PM7QR7hpmMKKj9WtxufhCaebErKwlYWzGIIgyI+Q/Kjo+MJ9jBDoGRs9qNRwiApHJ8G9rBeGhbFZkLxrVljA+hsIoOfyLOEVDYkXjDpQ3v74Mgyg5FDasdvNwbqqM3O3MU7sxAStxq5X6TgM2cranhHltHj5VfN2B9xVW9OpyFW5MfnhdBajt/wVlqWIV3cWSJQAAAABJRU5ErkJggg=="})])),_:1}),p(s,{name:"account",modelValue:J.verify,"onUpdate:modelValue":a[2]||(a[2]=e=>J.verify=e),class:"input flex-1",type:"text",maxlength:"11",placeholder:e.$t("login.register.verify")},null,8,["modelValue","placeholder"]),j.value?(d(),r(l,{key:1,class:"get-code get"},{default:c((()=>[m(g(D.value)+"s",1)])),_:1})):(d(),r(l,{key:0,class:"get-code gray",onClick:N},{default:c((()=>[m(g(e.$t("login.register.getVerify")),1)])),_:1}))])),_:1}),p(l,{class:"flex-start-center-nowrap"},{default:c((()=>[p(l,{class:"input-area flex-start-center-nowrap",style:{width:"384rpx"}},{default:c((()=>[p(s,{name:"account",modelValue:J.captcha,"onUpdate:modelValue":a[3]||(a[3]=e=>J.captcha=e),class:"input flex-1",type:"text",maxlength:"11",placeholder:e.$t("login.register.captcha")},null,8,["modelValue","placeholder"])])),_:1}),p(t,{class:"verify",mode:"widthFix",src:K.value.img,onClick:O},null,8,["src"])])),_:1}),p(l,{class:"input-area flex-start-center-nowrap"},{default:c((()=>[p(l,{class:"icon"},{default:c((()=>[p(t,{class:"image",src:b})])),_:1}),p(s,{name:"account",modelValue:J.nick_name,"onUpdate:modelValue":a[4]||(a[4]=e=>J.nick_name=e),class:"input flex-1",type:"text",placeholder:e.$t("login.register.nick_name")},null,8,["modelValue","placeholder"])])),_:1}),p(l,{class:"input-area flex-start-center-nowrap"},{default:c((()=>[p(l,{class:"icon"},{default:c((()=>[p(t,{class:"image",src:y})])),_:1}),p(s,{name:"account",modelValue:J.password,"onUpdate:modelValue":a[5]||(a[5]=e=>J.password=e),class:"input flex-1",type:Q.value?"text":"password",maxlength:"12",placeholder:e.$t("login.register.password")},null,8,["modelValue","type","placeholder"]),p(l,{class:"icon",onClick:a[6]||(a[6]=e=>Q.value=!Q.value)},{default:c((()=>[p(t,{class:"image",src:V})])),_:1})])),_:1}),p(l,{class:"input-area flex-start-center-nowrap"},{default:c((()=>[p(l,{class:"icon"},{default:c((()=>[p(t,{class:"image",src:y})])),_:1}),p(s,{name:"account",modelValue:J.realPassword,"onUpdate:modelValue":a[7]||(a[7]=e=>J.realPassword=e),class:"input flex-1",type:C.value?"text":"password",maxlength:"12",placeholder:e.$t("login.register.password")},null,8,["modelValue","type","placeholder"]),p(l,{class:"icon",onClick:a[8]||(a[8]=e=>C.value=!C.value)},{default:c((()=>[p(t,{class:"image",src:V})])),_:1})])),_:1}),p(l,{class:"btn",onClick:Z},{default:c((()=>[m(g(e.$t("login.register.post")),1)])),_:1}),p(l,{class:"btn line flex-center-center",onClick:a[9]||(a[9]=a=>e.toUrl("/pages/login/login"))},{default:c((()=>[m(g(e.$t("login.register.backLogin")),1)])),_:1})])),_:1})])),_:1})}}},[["__scopeId","data-v-4124ed74"]]);export{E as default};