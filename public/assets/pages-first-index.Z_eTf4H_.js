import{_ as e,u as a,r as s,p as t,y as l,a as o,w as n,i,o as r,b as c,d as u,t as g,K as A,B as d,k as p}from"./index-yugOe5W0.js";import{a as f,o as m}from"./uni-app.es.BSPlUZPV.js";import{c as y}from"./index.Di88n5Po.js";import"./request.BoWs2maN.js";const _=""+new URL("bg-CAnSDiyK.png",import.meta.url).href,h="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAAXNSR0IArs4c6QAAAIpJREFUOE/N1DsOgDAMA1B7h6syA2Xkd2ujDiyINglCiM7VU+MmIV4+fNnDd6CkDkBLcolUUXyhpBFAxnaSgxetlixpA9BHUDPDKGqCudQI6gIjqBu8oInkevdRT8Gp1E5u0JujC/RiOQITjGAmGMWqoKQEYI5MiQXm5dCU2qM022aG3qVw3vs/eAAyekQVuFNC8gAAAABJRU5ErkJggg==",k=e({__name:"index",setup(e){const{t:k,setLocale:U,locale:w}=a();a();const C=s({language:"",country:""});let v=0;f((e=>{e.hasOwnProperty("code")&&t("invite_mobile",e.code),v=e.type,y().then((({data:e})=>{t("localeList",e),console.log(e)}))})),m((()=>{const{language:e,country:a}=l("locale");C.value.country=a,C.value.language=e.name,(null==e?void 0:e.name)&&w._setter(e.id)}));const x=()=>{console.log(v);const{language:e,country:a}=l("locale");console.log(e,a),e&&a?A({url:1==v?"/pages/login/register":"/pages/login/login",fail:()=>{}}):d({title:k("first.valider"),icon:"none"})};return(e,a)=>{const s=i,t=p;return r(),o(s,null,{default:n((()=>[c(s,{class:"title"},{default:n((()=>[u(g(e.$t("first.title")),1)])),_:1}),c(t,{class:"icon",mode:"widthFix",src:_}),c(s,{class:"picker",onClick:a[0]||(a[0]=a=>e.toUrl("/pages/first/language"))},{default:n((()=>[c(s,{style:{height:"inherit"},class:"flex-row-between-nowrap"},{default:n((()=>[c(s,{class:""},{default:n((()=>[u(g(C.value.language||e.$t("first.picker1")),1)])),_:1}),c(t,{class:"right-icon",src:h})])),_:1})])),_:1}),c(s,{class:"picker",onClick:a[1]||(a[1]=a=>e.toUrl("/pages/first/country"))},{default:n((()=>[c(s,{style:{height:"inherit"},class:"flex-row-between-nowrap"},{default:n((()=>[c(s,{class:""},{default:n((()=>[u(g(C.value.country||e.$t("first.picker2")),1)])),_:1}),c(t,{class:"right-icon",src:h})])),_:1})])),_:1}),c(s,{class:"btn",onClick:x},{default:n((()=>[u(g(e.$t("first.btn")),1)])),_:1})])),_:1})}}},[["__scopeId","data-v-c1609eb8"]]);export{k as default};
