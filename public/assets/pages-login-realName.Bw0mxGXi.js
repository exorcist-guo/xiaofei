import{_ as e,u as a,r as l,f as s,p as t,B as o,g as n,a as u,w as r,i as d,o as m,b as i,d as c,t as f,v as p,m as _,I as g}from"./index-B-4_BZ3m.js";import{b}from"./user.OKHCT0CY.js";import"./request.DUiy3VGW.js";const N=e({__name:"realName",setup(e){const{t:N}=a(),V=l(),$=s({name:"",id_number:""});t((()=>{V.value=o("userInfo").mobile,n({title:N("login.realName.title")})}));const h=()=>{b($).then((({data:e})=>{console.log(e),p({url:"/pages/index/index"})}))};return(e,a)=>{const l=d,s=_,t=g;return m(),u(l,{class:"page flex-column-start-center"},{default:r((()=>[i(l,{class:"form-item"},{default:r((()=>[i(l,{class:"label"},{default:r((()=>[c(f(e.$t("login.register.mobile"))+": ",1)])),_:1}),i(l,{class:"input-area"},{default:r((()=>[i(s,null,{default:r((()=>[c(f(V.value),1)])),_:1})])),_:1})])),_:1}),i(l,{class:"form-item"},{default:r((()=>[i(l,{class:"label"},{default:r((()=>[c(f(e.$t("login.realName.name"))+": ",1)])),_:1}),i(l,{class:"input-area"},{default:r((()=>[i(t,{modelValue:$.name,"onUpdate:modelValue":a[0]||(a[0]=e=>$.name=e),placeholder:e.$t("login.realName.inputName")},null,8,["modelValue","placeholder"])])),_:1})])),_:1}),i(l,{class:"form-item"},{default:r((()=>[i(l,{class:"label"},{default:r((()=>[c(f(e.$t("login.realName.code"))+": ",1)])),_:1}),i(l,{class:"input-area"},{default:r((()=>[i(t,{modelValue:$.id_number,"onUpdate:modelValue":a[1]||(a[1]=e=>$.id_number=e),placeholder:e.$t("login.realName.inputCode")},null,8,["modelValue","placeholder"])])),_:1})])),_:1}),i(l,{class:"btn",onClick:h},{default:r((()=>[c(f(e.$t("login.register.post")),1)])),_:1})])),_:1})}}},[["__scopeId","data-v-29f4b8f0"]]);export{N as default};