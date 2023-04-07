const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});


// function nhapUse(date) {
// 	console.log(date.value)
//     var use = date.value;
//     var dem = use.length
    
//     if(dem<8||dem>30){
//         date.style.border = "1px red solid"
//     }else{
//         date.style.border = "1px green solid"
//     }
// }

function createFrom() {
    var lf=0
    var name = document.getElementById('nameCreate')
    var phone = document.getElementById('phoneCreate')
    var email = document.getElementById('emailCreate')
    var pass = document.getElementById('passCreate')
    var chekCreate = document.getElementById('checkCreate')


    var checkName =  /^[a-zA-ZàáạãảầấậẩẫằắặẳẵăêèẹẻẽếềểệễửữừứựơớờợởỡđéâäãåąáấâăčćęèéêëėįìíîïłńòóôöõøùúûüươứớựųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u
    if(name.value.match(checkName)){
        name.style.border = '1px solid green'
    }else{
        name.style.border = '1px solid red'
        lf=1
    }

    var checkEmail =  /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    if(email.value.match(checkEmail)){
        email.style.border = '1px solid green'
    }else{
        email.style.border = '1px solid red'
        lf=1
    }

    var checkPhone =   /^[0]([0-9]{9})$/
    if(phone.value.match(checkPhone)){
        phone.style.border = '1px solid green'
    }else{
        phone.style.border = '1px solid red'
        lf=1
    }

    var checkPass =   /^([A-Za-z0-9_-]{6,30})$/
    if(pass.value.match(checkPass)){
        pass.style.border = '1px solid green'
    }else{
        pass.style.border = '1px solid red'
        lf=1
    }


    if(lf==1) {
        chekCreate.innerHTML = 'You entered it wrong'
        return false
    }

}


function signInFrom() {
    var lf=0
    var email = document.getElementById('emailSignIn')
    var pass = document.getElementById('passSignIn')
    var chekCreate = document.getElementById('checkSignIn')

    var checkEmail =  /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    if(email.value.match(checkEmail)){
        email.style.border = '1px solid green'
    }else{
        email.style.border = '1px solid red'
        lf=1
    }

    var checkPass =   /^([A-Za-z0-9_-]{6,30})$/
    if(pass.value.match(checkPass)){
        pass.style.border = '1px solid green'
    }else{
        pass.style.border = '1px solid red'
        lf=1
    }

    if(lf==1) {
        return false
    }

}