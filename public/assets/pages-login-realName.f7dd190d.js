import{p as a,r as e,o as l,C as s,a as t,c as u,w as o,i as r,b as d,g as n,t as m,h as c,I as _}from"./index-54954f30.js";import{b as f}from"./user.c7eff9c5.js";import{_ as p}from"./_plugin-vue_export-helper.1b428a4d.js";import"./request.a96bd30e.js";const i=p({__name:"realName",setup(p){const i=a(),b=e({name:"",id_number:""});l((()=>{i.value=s("userInfo").mobile}));const h=()=>{f(b).then((({data:a})=>{console.log(a)}))};return(a,e)=>{const l=r,s=c,f=_;return t(),u(l,{class:"page flex-column-start-center"},{default:o((()=>[d(l,{class:"form-item"},{default:o((()=>[d(l,{class:"label"},{default:o((()=>[n("手机号: ")])),_:1}),d(l,{class:"input-area"},{default:o((()=>[d(s,null,{default:o((()=>[n(m(i.value),1)])),_:1})])),_:1})])),_:1}),d(l,{class:"form-item"},{default:o((()=>[d(l,{class:"label"},{default:o((()=>[n("姓名: ")])),_:1}),d(l,{class:"input-area"},{default:o((()=>[d(f,{modelValue:b.name,"onUpdate:modelValue":e[0]||(e[0]=a=>b.name=a),placeholder:"请填写姓名"},null,8,["modelValue"])])),_:1})])),_:1}),d(l,{class:"form-item"},{default:o((()=>[d(l,{class:"label"},{default:o((()=>[n("身份证号: ")])),_:1}),d(l,{class:"input-area"},{default:o((()=>[d(f,{modelValue:b.id_number,"onUpdate:modelValue":e[1]||(e[1]=a=>b.id_number=a),placeholder:"请填写身份证号"},null,8,["modelValue"])])),_:1})])),_:1}),d(l,{class:"btn",onClick:h},{default:o((()=>[n("提交")])),_:1})])),_:1})}}},[["__scopeId","data-v-5b70c1a2"]]);export{i as default};
