"use strict";

/** Gallery carousel */
const items = [...document.querySelectorAll(".gallery__item")];
const total = items.length;
let activeIndex = 0;

function render() {
  items.forEach((item, i) => {
    let position = (i - activeIndex + total) % total;
    if (position > total / 2) {
      position -= total;
    }
    item.className = "gallery__item pos-" + position;
  });
}

items.forEach((item, i) => {
  item.addEventListener("click", () => {
    activeIndex = i;
    render();
  });
});

render();

/*Testimonials accordion*/

document.querySelectorAll("[data-testimonial]").forEach((card) => {
  const header = card.querySelector(".testimonial__header");
  header.addEventListener("click", () => {
    const isActive = card.classList.contains("is-active");

    document.querySelectorAll("[data-testimonial]").forEach((c) => {
      c.classList.remove("is-active");
      c.querySelector(".testimonial__header").setAttribute(
        "aria-expanded",
        "false",
      );
    });

    if (!isActive) {
      card.classList.add("is-active");
      header.setAttribute("aria-expanded", "true");
    }
  });
});

/*Sticky-header*/
const header = document.querySelector(".header");

if (header) {
  const onScroll = () => {
    if (window.scrollY > 50) {
      header.classList.add("is-scrolled");
    } else {
      header.classList.remove("is-scrolled");
    }
  };
  window.addEventListener("scroll", onScroll, { passive: true });
  onScroll();
}
/*Form-handler */

function handleForm(formId, messageId, actionName) {
  const form = document.getElementById(formId);
  const message = document.getElementById(messageId);

  if (!form || !message) return;

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    // 1. Валидация на стороне клиента
    if (!form.checkValidity()) {
      message.textContent =
        "Необходимо корректно заполнить все поля и поставить галочку согласия.";
      message.className = "form-message form-message--error";
      message.hidden = false;
      return;
    }

    // 2. Блокировка кнопки
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.style.opacity = "0.6";
    message.hidden = true; // Скрываем старые сообщения

    // 3. Сбор данных
    const formData = new FormData(form);

    formData.append("action", actionName);

    const nonceField = form.querySelector('input[name="contact_nonce"]');
    if (nonceField) {
      formData.append("nonce", nonceField.value);
    } else {
      formData.append("nonce", ajax_object.nonce);
    }

    try {
      // 4. Отправка на сервер
      const response = await fetch(ajax_object.ajax_url, {
        method: "POST",
        body: formData,
      });

      if (!response.ok) {
        throw new Error("Network response was not ok");
      }

      const text = await response.text();

      // Если сервер вернул -1, значит сработала защита
      if (text === "-1") {
        throw new Error("Security check failed");
      }

      const result = JSON.parse(text);

      message.hidden = false;

      if (result.success) {
        // Успех от PHP
        message.textContent = result.data.message;
        message.className = "form-message form-message--success";
        form.reset(); // Очищаем форму

        // Скрываем сообщение через 7 секунд
        setTimeout(() => {
          message.hidden = true;
        }, 5000);
      } else {
        // Ошибка от PHP (например, не заполнено поле или сервер не отправил письмо)
        message.textContent = result.data.message;
        message.className = "form-message form-message--error";
      }
    } catch (error) {
      // Ошибка сети (сервер вообще недоступен)
      console.error("Ошибка:", error);
      message.hidden = false;
      message.textContent =
        "Произошла ошибка на сервере. Попробуйте позже или перезвоните нам.";
      message.className = "form-message form-message--error";
    } finally {
      // 5. Возвращаем кнопку в исходное состояние
      submitBtn.disabled = false;
      submitBtn.style.opacity = "1";
      submitBtn.innerHTML = originalText;
    }
  });
}
// Инициализация форм записи
if (document.getElementById("appointmentForm")) {
  handleForm("appointmentForm", "appointmentMessage", "process_appointment");
}
if (document.getElementById("contactForm")) {
  handleForm("contactForm", "contactMessage", "process_contact");
}

// --- Логика Cookie-баннера ---
const cookieBanner = document.getElementById("medio-cookie-banner");
const acceptCookiesBtn = document.getElementById("medio-accept-cookies");

if (cookieBanner && acceptCookiesBtn) {
  // Показываем баннер с задержкой
  setTimeout(() => {
    cookieBanner.classList.add("show");
  }, 1000);

  acceptCookiesBtn.addEventListener("click", () => {
    const date = new Date();
    date.setTime(date.getTime() + 365 * 24 * 60 * 60 * 1000);
    document.cookie =
      "medio_cookie_consent=accepted; expires=" +
      date.toUTCString() +
      "; path=/";

    cookieBanner.classList.remove("show");
    setTimeout(() => {
      cookieBanner.remove();
    }, 400);
  });
}
