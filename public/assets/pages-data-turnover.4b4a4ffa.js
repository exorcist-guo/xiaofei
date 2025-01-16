import{r as a,o as e,a as s,c as t,w as l,i as r,b as n,g as c,t as p,d,e as m,F as o,f as A,S as u}from"./index-48b86b6b.js";import{p as f,a as v}from"./data.5bce0d19.js";import{_ as w}from"./_plugin-vue_export-helper.1b428a4d.js";import"./request.f7e270e6.js";const g="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIYAAAAoCAYAAAA7b4IPAAAAAXNSR0IArs4c6QAABTRJREFUeF7tmterXFUUxn+fvfdesStW7BXbg0bBt6gPIuiLKEZE9MU38UHQP0AUxeCDYlQsGAtiLIEoWIIYe++9p2qS5f50z814c2bumcmMGefs9XJzM/vsWevb3/5WOVcUKwhUIKCCSkGgCoFCjMKLSgQKMQoxCjEKB+ojsJpiRMS1wGxJb9ffpqwcNwT+RYyI2Bl4HdgOmAfcDcyS9Mu4BV7i6Y5AlWKcDJwInJt/rgCeBO4DHpf0awF1/BGoIsZpbWFvAZwJnAEcDPwJPGeCAE9Jemf8IWpmhFMRox2V7YGWmhwGbAB8nUjzAvAS8IrTkKTfe4EyIrYE9ge2AgL4AnhfkpWq2FpCoBditLu4EWByHAEcmg/WRFkJfOmDBT4HvgF+BhYDPuj1AavQjsBewCHA7sBkP1zTPJHW3Spp7lrCZqBfGxHrARtadSX9MdDNh7BZv8SY7IqD3hPYB9gD2BWwwmwNbJ4BWTenIpPEB2/SfAp8lH/+BqyTSWPSOX15z9nADEkf9xt/RLiY3glYbsJKWtTvXlM9FxGO4Tjg9OT7McCBwG7Apm0XwN/v+N8DFmTFnSvp+6n2H8bnETEtndFNyY+zJdmv1W4qEdFeYwzDj172PBW4HNgEuErSzLoPR4TV6DLgvEzW1qNWrreS2j0MzJRkYq6xRcSRieCXANMzuX34rsE+Ab4DnGKtFL5Eviwmq9VyX2CHrLavAQ+leu5+SVbdoVpEbJOwvRm4NNWSVubpkuzryBPDPpoUM8zmlLLuSSBf0a0zigjfzlvS4Z+fyPRTLpZ9K38ArFr+3Ip0ErBxSoUPpv+/UZLX9GQR4dRwYdr7SuDo5OePwDMZZJPPqbWOWV1NLCvN8YBT9YvJ1zvyuGCgChcRjtsX7vqs5rcD90pynfi3VaUS39JRNHdH1+Q0dJ3bZ0kTwEfEtvmAPKDzzbzTnVNOH1XxGPyz8sG65pmV8LihTqcVEbtkNbIi+ba/DDySU8KaFs3264Q8LjBZFuZRgccFz0tyOuzLIsKp2apmUhgvd5d35Qu0UNKr3YjhzsPmDqGSPB28mrx+GM/7EK7O3dFX+WZaoi3HVgB/p6XYKceA1vHf0n5OqnUuzvL+KHAbMEeS2/N/wIiwcjkXX5QPzZ95vvNALrSHEb8HjvbNaul/W5HmZBU0GRdIWtKJJRGxWVYin6nnUlajZbmw90Vwo9CyRZLmdyOG5WzUzQWdb/sBOR18C5jtT2dF6cd/d0w+hAvSxHfvTKw3836uB1yzuPN6N6WNxzK4A5X4KZx2zKekW35sUpCDcq1ixfQF8djABb3VxER36+8GwGRyVrCfJpJHC88CVWRaLOmNbsQ4qh9Ux+wZE84dhQnibsKq5A7C85rPRiBWE3S/7J8J4LTggtY1lFOZ/bW6eGRgvz+sUe8skeS6qFpmI+LwEQi8uPDfI7BUktWwIzE8+m7lSy+q+zcb7Tm2PL/qYP8v+C2T9EE3Yng8Xax5CHgiOzFErGpXnVeLNQ8BE8M1ScdU4pF2seYhsFySO5yOxHCL08naFWZyHdH+e3m+GoFRxm+FJLf9HYnh8Wyx5iGwUpJb3I7E8BvRYs1DwMSY+Ou8quLTg5JizUMgJLVeI1S+RPNLnF7NBKtTY3SrPcrzvaK+av1A8Je0tFsq8ay9WAMRaH9zW3cq10CYmh1yIUazz79j9IUYhRiVCBRiFGIUYhQO1EegKEZ9rBq1shCjUcddP9hCjPpYNWplIUajjrt+sIUY9bFq1MpCjEYdd/1g/wLQVX04vVWBmgAAAABJRU5ErkJggg==",b=w({__name:"turnover",setup(w){const b=a({page:1,data:[],month_pv:"",last_month_pv:"",pv:""});e((()=>{B(),i()}));const B=()=>{f().then((({data:a})=>{console.log(a),b.month_pv=Number(a.month_pv),b.last_month_pv=Number(a.last_month_pv),b.pv=Number(a.pv)}))},i=()=>{v({page:b.page}).then((({data:a})=>{b.page+=1,b.data=[...b.data,...a]}))};return(a,e)=>{const f=r,v=A,w=u;return s(),t(f,{class:"page"},{default:l((()=>[n(f,{class:"banner flex-row-between-nowrap"},{default:l((()=>[n(f,{class:"item flex-1"},{default:l((()=>[n(f,{class:"label"},{default:l((()=>[c("当月新增")])),_:1}),n(f,{class:"nums"},{default:l((()=>[c(p(b.month_pv),1)])),_:1}),n(v,{class:"icon",src:g})])),_:1}),n(f,{class:"item flex-1"},{default:l((()=>[n(f,{class:"label"},{default:l((()=>[c("上月新增")])),_:1}),n(f,{class:"nums"},{default:l((()=>[c(p(b.last_month_pv),1)])),_:1}),n(v,{class:"icon",src:g})])),_:1}),n(f,{class:"item flex-1"},{default:l((()=>[n(f,{class:"label"},{default:l((()=>[c("总营业额")])),_:1}),n(f,{class:"nums"},{default:l((()=>[c(p(b.pv),1)])),_:1}),n(v,{class:"icon",src:g})])),_:1})])),_:1}),n(f,{class:"title flex-row-between-nowrap"},{default:l((()=>[n(f,{class:"tt"},{default:l((()=>[c("记录")])),_:1}),n(f,{class:"flex-start-center-nowrap more"})])),_:1}),n(w,{class:"scroll","scroll-y":"",onScrolltolower:B},{default:l((()=>[(s(!0),d(o,null,m(b.data,(a=>(s(),t(f,{class:"item flex-row-between-nowrap",key:a.id},{default:l((()=>[n(f,null,{default:l((()=>[n(f,{class:"type"},{default:l((()=>[c(p(a.remark),1)])),_:2},1024),n(f,{class:"name"},{default:l((()=>[c(p(a.action_name),1)])),_:2},1024),n(f,{class:"date"},{default:l((()=>[c(p(a.created_at),1)])),_:2},1024)])),_:2},1024),n(f,{class:"price"},{default:l((()=>[c("+"+p(a.amount),1)])),_:2},1024)])),_:2},1024)))),128))])),_:1})])),_:1})}}},[["__scopeId","data-v-4e1639ae"]]);export{b as default};
