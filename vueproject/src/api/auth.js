export default function (instance){
    return {
        input(payload){
            return instance.post('vue',payload)
        }
    }
}