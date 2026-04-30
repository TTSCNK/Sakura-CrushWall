/*
* 点赞和评论交互功能
* 处理表白墙的点赞、显示评论和提交评论功能
*/

// 点赞功能
function likePost(love_id, button) {
    // 使用XMLHttpRequest发送请求
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../api/like.php?love_id=' + love_id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 1) {
                    // 点赞成功
                    button.classList.add('liked');
                    button.innerHTML = '❤️ <span class="like_count">' + response.count + '</span>';
                    // 可以添加一个简单的动画效果
                    button.style.transform = 'scale(1.2)';
                    setTimeout(function() {
                        button.style.transform = 'scale(1)';
                    }, 200);
                } else {
                    // 点赞失败，显示错误信息
                    alert(response.msg);
                }
            } catch (e) {
                alert('服务器响应异常');
            }
        }
    };
    xhr.send();
}

// 显示/隐藏评论区域
function showComments(love_id) {
    var comments_area = document.getElementById('comments_' + love_id);
    
    if (comments_area.style.display === 'none' || comments_area.style.display === '') {
        comments_area.style.display = 'block';
        // 获取评论列表
        loadComments(love_id);
    } else {
        comments_area.style.display = 'none';
    }
}

// 加载评论列表
function loadComments(love_id) {
    var comments_list = document.querySelector('#comments_' + love_id + ' .comments_list');
    comments_list.innerHTML = '加载中...';
    
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../api/get_comments.php?love_id=' + love_id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 1) {
                    // 清空评论列表
                    comments_list.innerHTML = '';
                    
                    if (response.count === 0) {
                        comments_list.innerHTML = '<div style="text-align: center; color: #999;">暂无评论，快来抢沙发吧！</div>';
                    } else {
                        // 添加评论项
                        response.comments.forEach(function(comment) {
                            var comment_item = document.createElement('div');
                            comment_item.className = 'comment_item';
                            comment_item.innerHTML = 
                                '<div class="comment_username">' + comment.username + '</div>' +
                                '<div class="comment_content">' + comment.content + '</div>' +
                                '<div class="comment_meta">' + comment.time + '  IP:' + comment.ip + '</div>';
                            comments_list.appendChild(comment_item);
                        });
                    }
                } else {
                    comments_list.innerHTML = '加载评论失败';
                }
            } catch (e) {
                comments_list.innerHTML = '服务器响应异常';
            }
        }
    };
    xhr.send();
}

// 提交评论
function submitComment(love_id, button) {
    var textarea = button.parentNode.querySelector('.comment_textarea');
    var usernameInput = button.parentNode.querySelector('.comment_name');
var username = usernameInput ? usernameInput.value.trim() : '';
var content = textarea.value.trim();

if (content === '') {
        alert('评论内容不能为空');
        return;
    }
    
    if (content.length > 255) {
        alert('评论内容不能超过255个字符');
        return;
    }
    
    // 禁用按钮，防止重复提交
    button.disabled = true;
    button.innerHTML = '提交中...';
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../api/comment.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 1) {
                    // 评论成功，清空输入框并重新加载评论列表
                    textarea.value = '';
                    loadComments(love_id);
                    
                    // 更新评论数
                    var comment_count_element = document.querySelector('#love_' + love_id + ' .comment_count');
                    if (comment_count_element) {
                        var current_count = parseInt(comment_count_element.textContent);
                        comment_count_element.textContent = current_count + 1;
                    }
                } else {
                    alert(response.msg);
                }
            } catch (e) {
                alert('服务器响应异常');
            }
            
            // 恢复按钮
            button.disabled = false;
            button.innerHTML = '发表';
        }
    };
    xhr.send('love_id=' + love_id + '&content=' + encodeURIComponent(content) + '&username=' + encodeURIComponent(username));
}

// 内容展开功能
function zknr(element) {
    var full_content = element.getAttribute('id');
    element.innerHTML = full_content;
}