function validateForm(input, regex) {
  if (!regex.test(input.value)) {
    input.classList.add("is-invalid");
    input.classList.remove("is-valid");
    return false;
  } else {
    input.classList.remove("is-invalid");
    input.classList.add("is-valid");
    return true;
  }
}

document.querySelector("#form-signup").addEventListener("submit", (e) => {
  e.preventDefault();
  const loginInput = document.querySelector("#login");
  const passwordInput = document.querySelector("#password");
  const isLoginValid = validateForm(
    loginInput,
    /^[a-zA-Z][a-zA-Z0-9-_.]{4,20}$/
  );
  const isPasswordValid = validateForm(
    passwordInput,
    /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/
  );

  if (isLoginValid && isPasswordValid) {
    document.querySelector("#form-signup").submit();
  }
});
