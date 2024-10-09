CREATE DATABASE IF NOT EXISTS katolika_db;

USE katolika_db;

CREATE TABLE roles
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

INSERT INTO roles (name) VALUES
     ('Mpandrindra'),
     ('Faritra'),
     ('Fikambanana Masina'),
     ('Vaomieran’asa'),
     ('Mpikambana'),
     ('Mpikambana Tsotra');

CREATE TABLE regions
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE associations
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE committees
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE responsibilities
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE sacraments
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE cash_registers
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    reason       VARCHAR(250)   NOT NULL,
    type         VARCHAR(255)   NOT NULL,
    amount       DECIMAL(10, 2) NOT NULL,
    date         DATE,
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users
(
    id                INT AUTO_INCREMENT PRIMARY KEY,
    role_id           INT,
    first_name        VARCHAR(255) NOT NULL,
    last_name         VARCHAR(255) NOT NULL,
    cin               VARCHAR(20) UNIQUE,
    photo             VARCHAR(200),
    qr_code           VARCHAR(200),
    birth_date        DATE         NOT NULL,
    address           VARCHAR(255) NOT NULL,
    gender            VARCHAR(110) NOT NULL,
    apv               VARCHAR(100),
    responsibility_id INT,
    created_at        TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at        TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles (id) ON DELETE SET NULL,
    FOREIGN KEY (responsibility_id) REFERENCES responsibilities (id) ON DELETE SET NULL
);
--- admin
INSERT INTO users (role_id, first_name, last_name, cin, photo, qr_code, birth_date, address, username, gender, apv, responsibility_id)
VALUES
    (1, 'Alice', 'Dupont', 'CN123456', 'alice_photo.jpg', 'qr_code_alice.png', '1985-06-15', '123 Main St, Paris', 'alice.dupont', 'Female', 'APV123', NULL);
-- user
INSERT INTO users (role_id, first_name, last_name, cin, photo, qr_code, birth_date, address, username, gender, apv, responsibility_id)
VALUES
    (6, 'Bob', 'Martin', 'CN654321', 'bob_photo.jpg', 'qr_code_bob.png', '1990-03-22', '456 Elm St, Lyon', 'user.bob', 'Male', 'APV456', NULL);

CREATE TABLE members
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    region_id      INT,
    association_id INT,
    committee_id   INT,
    name VARCHAR(255) NOT NULL,
    created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (region_id) REFERENCES regions (id) ON DELETE SET NULL,
    FOREIGN KEY (association_id) REFERENCES associations (id) ON DELETE SET NULL,
    FOREIGN KEY (committee_id) REFERENCES committees (id) ON DELETE SET NULL
);

CREATE TABLE activities
(
    id              INT AUTO_INCREMENT PRIMARY KEY,
    name            VARCHAR(250) NOT NULL,
    description     TEXT,
    start_date      TIMESTAMP NULL,
    duration        VARCHAR(255) NULL,
    location        VARCHAR(255),
    isTruth       VARCHAR(250) NOT NULL,
    organizer_id    INT,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (organizer_id) REFERENCES users (id) ON DELETE SET NULL,
    CHECK (isTruth IN ('TOUS', 'ADMIN', 'FARITRA', 'FIKAMBANANA', 'VAOMIERAN''ASA'))
);


CREATE TABLE member_users
(
    member_id INT,
    user_id   INT,
    PRIMARY KEY (member_id, user_id),
    FOREIGN KEY (member_id) REFERENCES members (id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);

CREATE TABLE user_sacraments
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    user_id        INT          NOT NULL,
    sacrament_id   INT          NOT NULL,
    sacrament_date DATE         NOT NULL,
    location       VARCHAR(255) NOT NULL,
    created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (sacrament_id) REFERENCES sacraments (id) ON DELETE CASCADE
);

CREATE TABLE attendances
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    activity_id INT,
    user_id    INT,
    is_present BOOLEAN NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (activity_id) REFERENCES activities (id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);

CREATE TABLE operations
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    name           VARCHAR(255)   NOT NULL,
    ticket_count   INT            NOT NULL,
    operation_date DATE           NOT NULL,
    description    VARCHAR(255)   NOT NULL,
    ticket_price   DECIMAL(10, 2) NOT NULL,
    created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE events
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(255) NOT NULL,
    description TEXT,
    start_date  TIMESTAMP NOT NULL,
    end_date    TIMESTAMP NOT NULL,
    location    VARCHAR(255),
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

ALTER TABLE events
    ADD COLUMN organizer_id INT,
ADD FOREIGN KEY (organizer_id) REFERENCES users(id) ON DELETE SET NULL;


CREATE TABLE tickets
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    `from`       INT NOT NULL,
    `to`         INT NOT NULL,
    user_id      INT NOT NULL,
    is_paid      BOOLEAN   DEFAULT FALSE,
    distribution VARCHAR(255),
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);
ALTER TABLE tickets
    ADD COLUMN event_id INT NOT NULL,
ADD FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE;


CREATE TABLE user_responsibilities_histories
(
    id                  INT AUTO_INCREMENT PRIMARY KEY,
    user_id             INT NOT NULL,
    responsibility_id   INT NOT NULL,
    start_date          TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    end_date            TIMESTAMP NULL,
    created_at          TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at          TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (responsibility_id) REFERENCES responsibilities (id) ON DELETE CASCADE
);

