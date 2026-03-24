import unittest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from webdriver_manager.chrome import ChromeDriverManager


class LoginLaravelTest(unittest.TestCase):

    def setUp(self):
        self.driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()))
        self.driver.maximize_window()
        self.wait = WebDriverWait(self.driver, 10)
        self.url_login = "http://127.0.0.1:8000/login"

        # Reemplaza por un usuario real
        self.email_valido = "josseerivera1@gmail.com"
        self.password_valido = "jose12345"

    def test_login_exitoso(self):
        driver = self.driver
        driver.get(self.url_login)

        campo_email = self.wait.until(
            EC.presence_of_element_located((By.ID, "loginEmail"))
        )
        campo_password = driver.find_element(By.ID, "loginPassword")
        boton_acceder = driver.find_element(By.XPATH, "//button[@type='submit' and contains(., 'Acceder')]")

        campo_email.send_keys(self.email_valido)
        campo_password.send_keys(self.password_valido)
        boton_acceder.click()

        self.wait.until(EC.url_changes(self.url_login))
        self.assertNotEqual(driver.current_url, self.url_login)

        print("Login exitoso: el usuario ingresó correctamente.")

    def test_login_fallido(self):
        driver = self.driver
        driver.get(self.url_login)

        campo_email = self.wait.until(
            EC.presence_of_element_located((By.ID, "loginEmail"))
        )
        campo_password = driver.find_element(By.ID, "loginPassword")
        boton_acceder = driver.find_element(By.XPATH, "//button[@type='submit' and contains(., 'Acceder')]")

        campo_email.send_keys("usuario_inexistente@correo.com")
        campo_password.send_keys("clave_incorrecta")
        boton_acceder.click()

        self.wait.until(
            lambda d: d.current_url == self.url_login or len(d.find_elements(By.CLASS_NAME, "alert")) > 0
        )

        alertas = driver.find_elements(By.CLASS_NAME, "alert")
        self.assertTrue(driver.current_url == self.url_login or len(alertas) > 0)

        print("Login fallido: el sistema rechazó las credenciales incorrectas.")

    def test_login_campos_vacios(self):
        driver = self.driver
        driver.get(self.url_login)

        boton_acceder = self.wait.until(
            EC.presence_of_element_located((By.XPATH, "//button[@type='submit' and contains(., 'Acceder')]"))
        )
        boton_acceder.click()

        self.wait.until(
            lambda d: d.current_url == self.url_login or len(d.find_elements(By.CLASS_NAME, "alert")) > 0
        )

        alertas = driver.find_elements(By.CLASS_NAME, "alert")
        self.assertTrue(driver.current_url == self.url_login or len(alertas) > 0)

        print("Validación correcta: no se permitió login con campos vacíos.")

    def tearDown(self):
        self.driver.quit()


if __name__ == "__main__":
    unittest.main()