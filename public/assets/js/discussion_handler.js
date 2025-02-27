/**
 * @author Calvince Owino
 * @company Jalsoft
 * @position CEO
 * @see jalikoa.github.io/jalsoft
 */
// Add new discussion
// Load all discussions name about members ---- members username country image role-in-discussion online typing
// Load messages selected discussions members --- members username country image role-in-discussion online typing
// Load notifications new messages 
// Here add the encryption to encrypt the use data as they leave the page and decrypt them on arrival end-to-end encryption
// Get new messages without reloading the page 
// Update that the user is typing on the other end
// Make the ui to more or quite professinall
var addDiscussionForm,disName,disImage,disAbout,disType,disWhoMess,messageBox,messagesHolder,messagesForm,newMessAudio;
let sendTypeR,sendMessR,newMList,messLen,meSend,upd;
sendTypeR = true;
sendMessR = true;
meSend = false;
upd = true;
addDiscussionForm = byId('addDiscussionForm');
disName = byId('discName');
messagesForm = byId('messagesForm');
disImage = byId('discImage');
disAbout = byId('discAbout');
disType = byId('discType');
disWhoMess = byId('whoMess');
messageBox =byId('messageBox');
messagesHolder = byId('messagesHolder');
newMessAudio = byId('newMessAudio');
messageBox.addEventListener('input',()=>{
    if(sendTypeR){
        updateTyping();
    }
});
messagesForm.addEventListener('submit',(e)=>{
    e.preventDefault();
    if(sendMessR){
        sendMessage(sessid,'1',messageBox.value,'0','0');
        const cont = `<p class="message-text-text mb-4">${messageBox.value}</p>
                        <span class="received-time text-small position-absolute start-0 m-1 bottom-0"> 00:34 AM</span>
                        <span class="sent-status bi text-primary bi-check2-all position-absolute end-0 m-1 bottom-0"></span>`;
        const sentDiv = document.createElement('div');
        sentDiv.classList.add('message-text');
        sentDiv.classList.add('message-sent');
        sentDiv.classList.add('position-relative');
        sentDiv.classList.add('mt-3');
        sentDiv.innerHTML = cont;
        messagesHolder.append(sentDiv);
        messageBox.value = "";
    }
})
addDiscussionForm.addEventListener('submit',(e)=>{
    e.preventDefault();
    if(isEmpty(disName.value) || isEmpty(disAbout.value) || isEmpty(disType.value) || isEmpty(disWhoMess.value)){
        swal.fire('Sorry','Action not completed please ensure all the fields are filled','error');
    } else {
        const adDiXhr = checkXml();
        adDiXhr.open('POST',route,true);
        adDiXhr.onload =()=>{
            console.log(adDiXhr.responseText);
        }
        const data = new FormData();
        data.append('addnewdiscussion','true');
        data.append('discussionname',disName.value);
        data.append('discussionimage',disImage.files[0]);
        data.append('discussionabout',disAbout.value);
        data.append('discussiontype',disType.value);
        data.append('sessid',sessid);
        data.append('whomess',disWhoMess.value);
        adDiXhr.send(data);
    }
});
function sendMessage(sessid,dissId,message,type,replyto){
    // The type of the message here is either edited original or more as time goes
    // I will add more here so that the message is validated before it is sent here like encryption but for the role of testing and h
    // having a prototype this should be just the way that it is 
    const sendXhr = checkXml();
    meSend = true;
    sendXhr.open('POST',route,true);
    setHeader(sendXhr);
    sendXhr.onload = ()=>{
        console.log(sendXhr.responseText);
        if(sendXhr.status == 200){
            try {
                const response = JSON.parse(sendXhr.responseText);
                if(response.success){
                    Swal.fire(
                        {toast:true,
                          position:'top-end',
                          icon:'success',
                          title: `${response.message}`,
                          showConfirmButton: false,
                          timer: 3000,
                          timerProgressBar: true,
                        }
                    )
                } else {
                    Swal.fire(
                        {toast:true,
                          position:'top-end',
                          icon:'error',
                          title: `${response.message}`,
                          showConfirmButton: false,
                          timer: 3000,
                          timerProgressBar: true,
                        }
                    )
                }
            } catch(e){
                swal.fire('Sorry','An uncaught exception occurred please try again later','error');
            }
        } else {

        }
    }
    const data = `sendmessage=${enc('true')}&sessid=${enc(sessid)}&discussionid=${enc(dissId)}&message=${enc(message)}&type=${enc(type)}&reply_to=${enc(replyto)}`;
    sendXhr.send(data);
}
function editMessage(messId,message){
    console.log(`Hey there you are about to edit message with this ID ${messId}`);
    byId('jalikoaEditBtn').click();
    byId('edInp').value = message;
    byId('edInp').focus();
    let newMess = byId('edInp').value;
    const edXhr = checkXml();
    // Add logics to confirm that the data is text
    // Add more logics here to encrypt the user messages
    edXhr.open('POST',route,true);
    setHeader(edXhr);
    const data = `editMessage=${enc('true')}&sessid=${enc(sessid)}&messId=${enc(messId)}&newMess=${enc(newMess)}`;
    edXhr.onload = ()=>{
        if(edXhr.response.status == 200){
            try {
                const response = JSON.parse(edXhr.responseText);
                if(response.success){
                    // Update the dom
                } else {

                }
            } catch (error) {
                swal.fire(
                    'Sorry',
                    'An uncaught exeption occurred',
                    'error'
                );
            }
        } else {
            // swal.fire({
                
            // });
        }
    }
    edXhr.send(data);
}
function deleteMessage(messId){
    console.log(`Hey there you are about to delete message with this ID ${messId}`);
    const delXhr = checkXml();
    delXhr.open('POST',route,true);
    setHeader(delXhr);
    delXhr.onload = ()=>{
        if(delXhr.status == 200){
            try{
                response = JSON.parse(delXhr.responseText);
                if(response.success){
                    // Show a toast message to the user here 
                    // then delete the message from the ui~
                } else {

                }
            } catch (e){

            }
        } else {
            swal.fire();
        }
    }
    const data = `delMess=${enc('true')}$messageId=${enc(messId)}&sessId=${enc(sessid)}`;
    delXhr.send(data);
}
function fetchMembers(dissId){
    const fetchMemXhr = checkXml();
    fetchMemXhr.open('POST',route,true);
    setHeader(fetchMemXhr);
    fetchMemXhr.onload = ()=>{
        if(fetchMemXhr.status == 200){
            try{
                const response = JSON.parse(fetchMemXhr.responseText);
                if(response.success){
                    // Get the user list ad populate them to the list 
                } else {
                    // Relay the erro to the user 
                }
            } catch (e){
                // Relay the error to the user
            }
        } else {
            swal.fire();
        }
    }
    const data = `fetchMembers=${enc('true')}&dissid=${enc(dissId)}&sessid=${sessid}`;
    fetchMemXhr.send(data);
}
function deleteMember(memberId,dissid){
    const delMemXhr = checkXml();
    delMemXhr.open('POST',route,true);
    setHeader(delMemXhr);
    delMemXhr.onload = ()=>{
        if(delMemXhr.status == 200){
            try{
                const response = JSON.parse(delMemXhr.responseText);
                if(response.success){
                    // Get the user list ad populate them to the list 
                } else {
                    // Relay the erro to the user 
                }
            } catch (e){
                // Relay the error to the user
            }
        } else {
            swal.fire();
        }
    }
    const data = `delMembers=${enc('true')}&dissid=${enc(dissId)}&memberid=${enc(memberId)}&sessid=${sessid}`;
    delMemXhr.send(data);
}
function checkAdmin(){
    const chU_a = checkXml();
    chU_a.open('POST',route,true);
    setHeader(chU_a);
    chU_a.onload = ()=>{
        if(chU_a.status == 200){
            try{
                const response = JSON.parse(chU_a.responseText);
                if(response.success){
                    // Get the user list ad populate them to the list 
                } else {
                    // Relay the erro to the user 
                }
            } catch (e){
                // Relay the error to the user
            }
        } else {
            swal.fire();
        }
    }
    const data = `checkUAdmin=${enc('true')}&dissid=${enc(dissId)}&sessid=${sessid}`;
    chU_a.send(data);
}
function updateTyping(){
    sendTypeR = !sendTypeR;
    const typingXhr = checkXml();
    typingXhr.open('POST',route,true);
    setHeader(typingXhr);
    typingXhr.onload = ()=>{
        sendTypeR = !sendTypeR;
        console.log(typingXhr.responseText);
    }
    const data = `updateTyping=${enc('true')}&sessid=${enc(sessid)}&dissid=${enc('1')}`;
    typingXhr.send(data);
}
function fetchMessages(){
    const fetchMessXhr = checkXml();
    fetchMessXhr.open('POST',route,true);
    setHeader(fetchMessXhr);
    fetchMessXhr.onload = ()=>{
        console.log(fetchMessXhr.responseText);
        let response;
        try{response = JSON.parse(fetchMessXhr.responseText)} catch(e){
            swal.fire('Sorry','An uncaught exception occured while trying to load chats from the database','error');
        }
        if(response){
            if(response.success){
                populateChats(response.messList);
            } else {
                swal.fire('Sorry',`${response.message}`,'error');
            }
        }
    }
    const data = `fetchmessages=${enc('true')}&sessid=${enc(sessid)}&discussionid=${enc('1')}`;
    fetchMessXhr.send(data);
}
window.onload = ()=>{
    fetchMessages();
}
function populateChats(list){
    messagesHolder.innerHTML = "";
    messLen = list.length;
    for(let i = 0;i < list.length;i++){
        if(list[i].you){
            const cont = `
            <span class="senderCred d-flex position-relative">
                <img src="../assets/img/messages-2.jpg" alt="">
                <span class="h-30 overflow-hidden fw-medium text-small">You</span>
                <span class="h-30 overflow-hidden">${list[i].country}</span>
                <div class="dropdown border-0">
                    <span data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></span>
                    <ul class="dropdown-menu">
                        <p class="text-small text-info">
                            Sent this text ${list[i].timesent}
                        </p>
                        <li class="dropdown-item">
                            <a href="#" onclick="editMessage('${list[i].id}','${list[i].message}')" class="text-secondary"><i class="text-primary bi bi-pencil-square"></i> Edit message</a>
                        </li>
                        <hr class="dropdow-divider">
                        <li class="dropdown-item">
                            <a href="#" onclick="deleteMessage(deleteMessage(messId))" class="text-secondary"><i class="text-primary bi bi-reply-all-fill"></i> Forward</a>
                        </li>
                        <!-- <li class="dropdown-item">
                            <a href="#" onclick="" class="text-secondary"><i class="text-primary bi bi-pencil-square"></i> Edit message</a>
                        </li> -->
                        <hr class="dropdow-divider">
                        <li class="dropdown-item">
                            <a href="#" onclick="deleteMessage(${list[i].id})" class="text-secondary"><i class="text-danger bi bi-trash-fill"></i> Delete Message</a>
                        </li>
                        <hr class="dropdow-divider">
                        <br class="dropdow-divider">
                    </ul>
                </div>
            </span>
            <p class="message-text-text mb-3" style="font-size:14px;">${list[i].message}</p>
            <span class="received-time text-small position-absolute start-0 m-1 bottom-0">${list[i].timesent}</span>
            <span class="sent-status bi text-primary bi-check2-all position-absolute end-0 m-1 bottom-0"></span>`;
        const sentDiv = document.createElement('div');
        sentDiv.classList.add('message-text');
        sentDiv.classList.add('message-sent');
        sentDiv.classList.add('position-relative');
        sentDiv.classList.add('mt-3');
        sentDiv.setAttribute('id',`${list[i].id}`);
        sentDiv.innerHTML = cont;
        messagesHolder.append(sentDiv);
        } else {
            if(!list[i].you){
                const cont = `
                <span class="senderCred d-flex position-relative">
                <span class="position-absolute top-0 start-0 ms-5" id='${list[i].id+'typ'}'><i class="text-xs ${list[i].typing} ">typing</i></span>
                <span class="position-absolute ${list[i].online} bottom-0 start-0 ms-4" id='${list[i].id+'onl'}'></span>
                <img src="../assets/img/messages-3.jpg" alt="">
                <span class="h-30 overflow-hidden fw-medium">${list[i].username}</span>
                <span class="h-30 overflow-hidden">${list[i].country}</span>
                <div class="dropdown border-0">
                    <span data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></span>
                    <ul class="dropdown-menu">
                        <p class="text-small text-info">
                            Sent this text ${list[i].timesent}
                        </p>
                        <li class="">
                            <div class="res-reaction mb-1">
                                <i class="bi bi-hand-thumbs-up ms-2"></i>
                                <i class="bi bi-hand-thumbs-down ms-2"></i>
                                <i class="bi bi-heart ms-2"></i>
                                <i class="bi bi-reply-all-fill ms-4" onclick="replyComment('3')"></i>
                            </div>
                        </li>
                        <hr class="dropdow-divider">
                        <br class="dropdow-divider">
                    </ul>
                </div>
            </span>
            <p class="message-text-text mb-4">${list[i].message}</p>
            <span class="received-time text-small position-absolute start-0 m-1 bottom-0">${list[i].timesent}</span>`;
        const sentDiv = document.createElement('div');
        sentDiv.classList.add('message-text');
        sentDiv.classList.add('message-received');
        sentDiv.classList.add('position-relative');
        sentDiv.classList.add('mt-3');
        sentDiv.classList.add('position-relative');
        sentDiv.innerHTML = cont;
        messagesHolder.append(sentDiv);
            }
        }
        messagesHolder.scrollTop = messagesHolder.scrollHeight;
    }
    messagesHolder.scrollTo(messagesHolder.style.height.value);
    checkNewMessage();
}
function updateOnlTyp(list) {
    upd = false;
    for (let i = 0; i < list.length; i++) {
        if (list[i] && list[i].id && list[i].typing && list[i].online) {
            let typ = document.getElementById(`${list[i].id + 'typ'}`);
            if (typ) {
                typ.innerHTML = `<i class="text-xs ${list[i].typing} ">typing...</i>`;
            }

            let onl = document.getElementById(`${list[i].id + 'onl'}`);
            if (onl) {
                if (onl.classList.contains('online')) {
                    onl.classList.remove('online');
                }
                if (onl.classList.contains('offline')) {
                    onl.classList.remove('offline');
                }
                onl.classList.add(`${list[i].online}`);
            }
        }
    }
    upd = true;
}
function checkNewMessage(){
    const fetchNewMess = checkXml();
    fetchNewMess.open('POST',route,true);
    setHeader(fetchNewMess);
    fetchNewMess.onload = ()=>{
        // console.log(fetchNewMess.responseText);
        let response;
        try{response = JSON.parse(fetchNewMess.responseText)} catch(e){
            swal.fire('Sorry','An uncaught exception occured while trying to load chats from the database','error');
        }
        if(response){
            if(response.success){
                if(response.messList.length  > messLen){
                    populateChats(response.messList);
                    if(!meSend){
                        newMessAudio.play();
                    } else {
                        meSend = false;
                    }
                    if(upd){
                        updateOnlTyp(response.messList);
                    }
                } else {
                    setTimeout(() => checkNewMessage(), 500);
                    if(upd){
                        updateOnlTyp(response.messList);
                    }
                }
            } else {
                swal.fire('Sorry',`${response.message}`,'error');
            }
        }
    }
    const data = `fetchmessages=${enc('true')}&sessid=${enc(sessid)}&discussionid=${enc('1')}`;
    fetchNewMess.send(data);
}
