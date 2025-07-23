// Wim Theme - script.js

document.addEventListener('DOMContentLoaded', function() {
  var menuToggle = document.getElementById('menuToggle');
  var mainNav = document.getElementById('mainNav');
  if (menuToggle && mainNav) {
    menuToggle.addEventListener('click', function() {
      mainNav.classList.toggle('open');
      var expanded = mainNav.classList.contains('open');
      menuToggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
    });
  }

  // Toast notification fonksiyonu
  document.wimToast = function(msg) {
    var toast = document.getElementById('wimToast');
    if (!toast) return;
    toast.textContent = msg;
    toast.classList.add('show');
    setTimeout(function() {
      toast.classList.remove('show');
    }, 1800);
  };

  // Upvote/Downvote işlevi (localStorage ile basit demo)
  document.querySelectorAll('.reddit-post').forEach(function(post, idx) {
    var upBtn = post.querySelector('.vote-btn.up');
    var downBtn = post.querySelector('.vote-btn.down');
    var countSpan = post.querySelector('.vote-count');
    if (!upBtn || !downBtn || !countSpan) return;
    var postId = post.id || 'post-' + idx;
    var voteKey = 'wim-vote-' + postId;
    var vote = localStorage.getItem(voteKey) || 'none';
    var baseCount = 0;
    // Başlangıçta aktiflik ve sayaç
    if (vote === 'up') {
      upBtn.classList.add('active','up');
      countSpan.textContent = 1;
    } else if (vote === 'down') {
      downBtn.classList.add('active','down');
      countSpan.textContent = -1;
    } else {
      countSpan.textContent = baseCount;
    }
    upBtn.addEventListener('click', function() {
      if (vote === 'up') {
        vote = 'none';
        upBtn.classList.remove('active','up');
        countSpan.textContent = baseCount;
        document.wimToast('vote removed');
      } else {
        vote = 'up';
        upBtn.classList.add('active','up');
        downBtn.classList.remove('active','down');
        countSpan.textContent = 1;
        document.wimToast('upvoted');
      }
      localStorage.setItem(voteKey, vote);
    });
    downBtn.addEventListener('click', function() {
      if (vote === 'down') {
        vote = 'none';
        downBtn.classList.remove('active','down');
        countSpan.textContent = baseCount;
        document.wimToast('vote removed');
      } else {
        vote = 'down';
        downBtn.classList.add('active','down');
        upBtn.classList.remove('active','up');
        countSpan.textContent = -1;
        document.wimToast('downvoted');
      }
      localStorage.setItem(voteKey, vote);
    });
  });
}); 