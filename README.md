# Security Guard

Security Guard is a web application designed to perform comprehensive security scans on provided domains or IP addresses. The application integrates with OpenVAS, ZAP Proxy, and Nmap to detect various vulnerabilities, including those listed in the OWASP Top 10.

## Features

-   **Light and Deep Scans**: Users can choose between light and deep scans for both IP addresses and domains using Nmap.
-   **OpenVAS Integration**: Perform detailed security scans using OpenVAS to detect a wide range of vulnerabilities.
-   **ZAP Proxy Integration**: Execute automated security tests using ZAP Proxy to identify issues such as XSS, SQL injection, and more.
-   **Detailed Scan Results**: Scan results are parsed and displayed in a user-friendly table format.

## Requirements

-   PHP 7.4 or higher
-   Laravel 8.x
-   Composer
-   Nmap
-   OpenVAS
-   ZAP Proxy

## Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/your-username/security-guard.git
    cd security-guard
    ```

2. **Install dependencies:**

    ```bash
    composer install
    npm install
    npm run dev
    ```

3. **Copy the `.env` file:**

    ```bash
    cp .env.example .env
    ```

4. **Generate the application key:**

    ```bash
    php artisan key:generate
    ```

5. **Set up your database in the `.env` file and run migrations:**

    ```bash
    php artisan migrate
    ```

6. **Set up Nmap, OpenVAS, and ZAP Proxy:**

    - Install and configure [Nmap](https://nmap.org/download.html).
    - Install and configure [OpenVAS](https://www.openvas.org/setup.html).
    - Install and configure [ZAP Proxy](https://www.zaproxy.org/download/).

## Usage

1. **Access the web interface:**

    Open your browser and navigate to `http://localhost:8000`.

2. **Submit a scan:**

    - Go to the scan form.
    - Enter either a domain or an IP address.
    - Select the type of scan you want to perform (Light, Deep, OpenVAS, ZAP Proxy).
    - Click the "Run" button.

3. **View scan results:**

    After the scan completes, the results will be displayed in a table format, showing detected vulnerabilities.

## Routes

-   `/` - Home page.
-   `/register` - User registration page.
-   `/login` - User login page.
-   `/logout` - User logout.
-   `/settings` - User settings page.
-   `/URL-option` - Scan submission form.
-   `/ip-result` - Display results for IP scans.
-   `/domain-result` - Display results for domain scans.

## Security Scanning Commands

-   **Light IP Scan**: `nmap -T4 -F <IP>`
-   **Deep IP Scan**: `nmap -sV -sS -sC -A <IP>`
-   **Light Domain Scan**: `nmap -T4 -F <Domain>`
-   **Deep Domain Scan**: `nmap -sV -sS -sC -A <Domain>`
-   **OpenVAS Scan**: `openvas-cli <Target>`
-   **ZAP Proxy Scan**: `zap-cli quick-scan <Target>`

## Contributing

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Commit your changes (`git commit -am 'Add new feature'`).
4. Push to the branch (`git push origin feature-branch`).
5. Create a new Pull Request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact

If you have any questions or need further assistance, please feel free to contact us at support@securityguard.com.
