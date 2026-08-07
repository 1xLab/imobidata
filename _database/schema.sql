CREATE TABLE IF NOT EXISTS missions (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  public_id VARCHAR(32) NOT NULL,
  mission_text TEXT NOT NULL,
  name VARCHAR(120) NOT NULL,
  whatsapp VARCHAR(40) NOT NULL,
  email VARCHAR(180) NULL,
  source VARCHAR(60) NOT NULL DEFAULT 'landing',
  consent_at DATETIME NOT NULL,
  ip_address VARCHAR(64) NULL,
  user_agent VARCHAR(500) NULL,
  created_at DATETIME NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uq_missions_public_id (public_id),
  KEY ix_missions_created_at (created_at),
  KEY ix_missions_whatsapp (whatsapp)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS partner_leads (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  company VARCHAR(160) NOT NULL,
  contact_name VARCHAR(120) NOT NULL,
  whatsapp VARCHAR(40) NOT NULL,
  region VARCHAR(180) NOT NULL,
  profile TEXT NULL,
  source VARCHAR(60) NOT NULL DEFAULT 'landing_partner',
  consent_at DATETIME NOT NULL,
  ip_address VARCHAR(64) NULL,
  user_agent VARCHAR(500) NULL,
  created_at DATETIME NOT NULL,
  PRIMARY KEY (id),
  KEY ix_partner_created_at (created_at),
  KEY ix_partner_company (company),
  KEY ix_partner_whatsapp (whatsapp)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
