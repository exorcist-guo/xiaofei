import{_ as a,r as e,f as l,p as s,a as t,w as o,i as n,o as r,b as i,d as c,t as d,e as u,q as p,v as g,x as f,k as m,I as _}from"./index-B-4_BZ3m.js";import{_ as x,a as w,b}from"./show.B0O9Pu_2.js";import{l as k,i as $}from"./user.OKHCT0CY.js";import"./request.DUiy3VGW.js";const h=a({__name:"login",setup(a){const h=e(!1),y=l({mobile:"",password:""});s((()=>{}));const V=()=>{k(y).then((async({data:a})=>{console.log(a),p("token",a.token);const e=await $();p("userInfo",e.data),a.is_real?g({url:"/pages/index/index"}):f({url:"/pages/login/realName"})}))};return(a,e)=>{const l=n,s=m,p=_;return r(),t(l,{class:"page flex-center-center"},{default:o((()=>[i(l,null,{default:o((()=>[i(l,{class:"title"},{default:o((()=>[c(d(a.$t("login.login.title")),1)])),_:1}),i(l,{class:"input-area flex-start-center-nowrap"},{default:o((()=>[i(l,{class:"icon"},{default:o((()=>[i(s,{class:"image",src:x})])),_:1}),i(p,{name:"account",modelValue:y.mobile,"onUpdate:modelValue":e[0]||(e[0]=a=>y.mobile=a),class:"input flex-1",type:"text",placeholder:a.$t("login.login.account")},null,8,["modelValue","placeholder"])])),_:1}),i(l,{class:"input-area flex-start-center-nowrap"},{default:o((()=>[i(l,{class:"icon"},{default:o((()=>[i(s,{class:"image",src:w})])),_:1}),i(p,{name:"password",modelValue:y.password,"onUpdate:modelValue":e[1]||(e[1]=a=>y.password=a),type:h.value?"text":"password",class:"input flex-1",placeholder:a.$t("login.register.password")},null,8,["modelValue","type","placeholder"]),i(l,{class:"icon",onClick:e[2]||(e[2]=a=>h.value=!h.value)},{default:o((()=>[i(s,{class:"image",src:b})])),_:1})])),_:1}),i(l,{class:"flex-row-between-nowrap label-area"},{default:o((()=>[i(l,{class:"ll",onClick:e[3]||(e[3]=e=>a.toUrl("/pages/login/fogetPassWord"))},{default:o((()=>[c(d(a.$t("login.login.forgetPass")),1)])),_:1}),i(l,{class:"ll register",onClick:e[4]||(e[4]=e=>a.toUrl("/pages/first/index?type=1"))},{default:o((()=>[c(d(a.$t("login.login.regest")),1)])),_:1})])),_:1}),i(l,{class:"btn",onClick:V},{default:o((()=>[c(d(a.$t("login.login.btn1")),1)])),_:1}),i(l,{class:"btn line",onClick:e[5]||(e[5]=e=>a.toUrl("/pages/first/index?type=0"))},{default:o((()=>[c(d(a.$t("login.login.btn3")),1)])),_:1}),u("",!0)])),_:1})])),_:1})}}},[["__scopeId","data-v-b03a8209"]]);export{h as default};
