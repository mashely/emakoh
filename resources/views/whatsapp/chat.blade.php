@extends('layouts.main')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">WhatsApp Chat</h4>
                </div>
            </div>
        </div>
        <div class="row" style="height:70vh;">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bx bx-search"></i></span>
                            <input type="text" id="search" class="form-control" placeholder="Search number or name">
                        </div>
                        <div id="conversations" class="flex-fill overflow-auto"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <div id="thread_header" class="mb-2 fw-semibold"></div>
                        <div id="thread" class="flex-fill overflow-auto border p-3 rounded bg-light"></div>
                        <div class="mt-3">
                            <div id="send_alert" class="mb-2"></div>
                            <div class="input-group">
                                <input type="text" id="message_input" class="form-control" placeholder="Type a message" disabled>
                                <button class="btn btn-success" id="send_btn" disabled><i class="bx bx-send"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
let selectedConversationId = null
function fmtTime(ts){ try { return new Date(ts).toLocaleString() } catch(e){ return ts } }
function renderConversations(items){
    const c = document.getElementById('conversations')
    c.innerHTML = ''
    if(!items.length){ c.innerHTML = '<div class="text-muted text-center mt-4">No conversations</div>'; return }
    items.forEach(it=>{
        const row = document.createElement('div')
        row.className = 'd-flex align-items-center justify-content-between p-2 border rounded mb-2 conversation-row'
        row.style.cursor = 'pointer'
        row.dataset.id = it.id
        row.innerHTML = `
            <div>
                <div class="fw-semibold">${it.display_name ? it.display_name : it.phone}</div>
                <div class="text-muted small">${it.last_message_preview || ''}</div>
            </div>
            <div class="text-end">
                <div class="small">${it.last_message_at ? fmtTime(it.last_message_at) : ''}</div>
                ${it.unread_count > 0 ? '<span class="badge bg-primary">'+it.unread_count+'</span>' : ''}
            </div>
        `
        row.addEventListener('click', ()=>openThread(it.id, it.display_name || it.phone))
        c.appendChild(row)
    })
}
function fetchConversations(){
    const q = document.getElementById('search').value
    const url = new URL("{{ route('whatsapp.chat.conversations') }}", window.location.origin)
    if(q) url.searchParams.set('q', q)
    fetch(url).then(r=>r.json()).then(renderConversations)
}
function openThread(id, title){
    selectedConversationId = id
    document.getElementById('thread_header').textContent = title
    document.getElementById('message_input').disabled = false
    document.getElementById('send_btn').disabled = false
    fetch("{{ url('whatsapp/chat/thread') }}/"+id).then(r=>r.json()).then(data=>{
        const t = document.getElementById('thread')
        t.innerHTML = ''
        data.messages.forEach(m=>{
            const bubble = document.createElement('div')
            bubble.className = 'mb-2 d-flex ' + (m.direction === 'out' ? 'justify-content-end' : 'justify-content-start')
            const inner = document.createElement('div')
            inner.className = 'p-2 rounded ' + (m.direction === 'out' ? 'bg-success text-white' : 'bg-white border')
            inner.innerHTML = `<div>${(m.text||'')}</div><div class="small text-muted mt-1">${fmtTime(m.sent_at)}</div>`
            bubble.appendChild(inner)
            t.appendChild(bubble)
        })
        t.scrollTop = t.scrollHeight
    })
}
document.addEventListener('DOMContentLoaded', function(){
    fetchConversations()
    document.getElementById('search').addEventListener('input', function(){ fetchConversations() })
    setInterval(fetchConversations, 15000)
    document.getElementById('send_btn').addEventListener('click', function(){
        if(!selectedConversationId) return
        const text = document.getElementById('message_input').value.trim()
        if(!text) return
        const fd = new FormData()
        fd.append('conversation_id', selectedConversationId)
        fd.append('text', text)
        fetch("{{ route('whatsapp.chat.send') }}",{
            method:'POST',
            headers:{ 'X-CSRF-TOKEN':document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content') },
            body: fd
        }).then(r=>r.json()).then(resp=>{
            const alertDiv = document.getElementById('send_alert')
            alertDiv.innerHTML = ''
            if(resp.success){
                document.getElementById('message_input').value = ''
                openThread(selectedConversationId, document.getElementById('thread_header').textContent)
                fetchConversations()
            }else{
                alertDiv.innerHTML = '<div class="alert alert-danger">'+(resp.errors || 'Failed')+'</div>'
            }
        })
    })
})
</script>
@endpush

