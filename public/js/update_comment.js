async function checkNewComments(company_id, field, show_notification=false){ 
    // show_notification - откл подсчет сообщений новых при первом запросе

    let response = await getCommentsByField(company_id, field)
    let comments_number_new = response['comments'].length

    if (comments_number_new > comments_number.get(field)){
        let new_number = comments_number_new - comments_number.get(field)
        let new_comments = response['comments'].slice(comments_number.get(field)) 
        insertCommentsToField(field, new_comments)
        comments_number.set(field, response['comments'].length)

        if (show_notification) {
            createNotification(field, new_number)}
    }
    setTimeout(checkNewComments, 1500, company_id, field, true)
}

function createNotification(field, number) {
    let new_comments_notif = document.getElementById('newComments_' + field)
    let new_value_unread = unread_number.get(field) + number
    unread_number.set(field, new_value_unread)
    if (new_value_unread > 0){
        new_comments_notif.innerHTML = '&times; Есть новые сообщения!' + ' (' + unread_number.get(field) + ')'}
}

function destroyNotification(field) {
    let new_comments_notif = document.getElementById('newComments_' + field)
    unread_number.set(field, 0)
    new_comments_notif.innerHTML = ''
}

async function getCommentsByField(company_id, field) {    
    const csrf = document.querySelector('meta[name="csrf-token"]').content;
    const headers = {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrf,
    }

    const request_body = {
        field: field,
        company_id: company_id,
    }
    const response = await fetch('/get-comments', {
        method: 'POST',
        headers: headers,
        body: JSON.stringify(request_body)
    })

    const data = await response.json()
    return data
  }

function insertCommentsToField(field, comments){
    let commentsElement = document.getElementById('comments_' + field);
   
    comments.forEach(element => {
        commentsElement.insertAdjacentHTML("afterBegin",
            "<p>" +
            element.created_at_formatted +
            " <span class=\"username\">" +
            element.username +
            "</span> <span class=\"comment\">" +
            element.comment +
            "</span></p>")
    });
}

function sendComment(){
    const textarea = document.getElementById('floatingTextarea')
    const comment = textarea.value.trim()
    textarea.value = ''

    if (comment.length === 0){
        return
    }

    const modalElement = document.getElementById('addCommentModal')
    const modal = bootstrap.Modal.getInstance(modalElement)
    modal.hide();

    const field = document.getElementById('field').value
    const company_id = document.getElementById('company-id').value

    if (unread_number.get(field) > 0) destroyNotification(field)

    // вычтем из счетчика новых свое добавленное, затем при проверке новых от сервера оно прибавится обратно, компенсируя вычтенное
    let new_value_unread = unread_number.get(field) - 1
    unread_number.set(field, new_value_unread)
 
    // запрос
    const csrf = document.querySelector('meta[name="csrf-token"]').content;
    const headers = {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrf,
    }

    const request_body = {
        comment: comment,
        field: field,
        company_id: company_id,
    }

    return fetch('/send-comment', {
        method: 'POST',
        headers: headers,
        body: JSON.stringify(request_body)
    })
}

function start(){
    const company_id = document.getElementById('company-id').value
    
    fields.forEach(field => {
        checkNewComments(company_id, field)
})
}

start()

