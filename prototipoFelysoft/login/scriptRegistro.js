document.addEventListener('DOMContentLoaded', function () {
  var current = null;

  document.querySelector('#name').addEventListener('focus', function (e) {
    if (current) current.pause();
    current = anime({
      targets: 'path',
      strokeDashoffset: {
        value: 0,
        duration: 700,
        easing: 'easeOutQuart'
      },
      strokeDasharray: {
        value: '240 1386',
        duration: 700,
        easing: 'easeOutQuart'
      }
    });
  });

  document.querySelector('#password').addEventListener('focus', function (e) {
    if (current) current.pause();
    current = anime({
      targets: 'path',
      strokeDashoffset: {
        value: -336,
        duration: 700,
        easing: 'easeOutQuart'
      },
      strokeDasharray: {
        value: '240 1386',
        duration: 700,
        easing: 'easeOutQuart'
      }
    });
  });

  document.querySelector('#submit').addEventListener('focus', function (e) {
    if (current) current.pause();
    current = anime({
      targets: 'path',
      strokeDashoffset: {
        value: -730,
        duration: 700,
        easing: 'easeOutQuart'
      },
      strokeDasharray: {
        value: '530 1386',
        duration: 700,
        easing: 'easeOutQuart'
      }
    });
  });

  document.querySelector('#login-form').addEventListener('submit', function (e) {
    e.preventDefault();
    var email = document.querySelector('#email').value;
    var password = document.querySelector('#password').value;

    if (email.trim() === '' || password.trim() === '') {
      alert('Por favor, completa todos los campos.');
      return;
    }

    // Redireccionar al usuario cuando se envíe el formulario
    window.location.href = '/login/index.html';
  });
});

  