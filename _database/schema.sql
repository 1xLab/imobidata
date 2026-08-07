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

CREATE TABLE IF NOT EXISTS agency_leads (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  company VARCHAR(160) NOT NULL,
  contact_name VARCHAR(120) NOT NULL,
  role_title VARCHAR(120) NULL,
  whatsapp VARCHAR(40) NOT NULL,
  email VARCHAR(180) NULL,
  region VARCHAR(180) NOT NULL,
  portfolio_profile TEXT NULL,
  team_size VARCHAR(60) NULL,
  integration_interest VARCHAR(60) NULL,
  source VARCHAR(60) NOT NULL DEFAULT 'landing_agency',
  consent_at DATETIME NOT NULL,
  ip_address VARCHAR(64) NULL,
  user_agent VARCHAR(500) NULL,
  created_at DATETIME NOT NULL,
  PRIMARY KEY (id),
  KEY ix_agency_created_at (created_at),
  KEY ix_agency_company (company),
  KEY ix_agency_whatsapp (whatsapp)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS broker_index_requests (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  public_id VARCHAR(32) NOT NULL,
  name VARCHAR(120) NOT NULL,
  creci VARCHAR(60) NULL,
  whatsapp VARCHAR(40) NOT NULL,
  source VARCHAR(60) NOT NULL DEFAULT 'landing_broker_index',
  status VARCHAR(30) NOT NULL DEFAULT 'pending',
  indexing_authorized_at DATETIME NOT NULL,
  consent_at DATETIME NOT NULL,
  ip_address VARCHAR(64) NULL,
  user_agent VARCHAR(500) NULL,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uq_broker_index_public_id (public_id),
  KEY ix_broker_index_status (status),
  KEY ix_broker_index_created_at (created_at),
  KEY ix_broker_index_whatsapp (whatsapp)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS broker_listing_sources (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  broker_index_request_id BIGINT UNSIGNED NOT NULL,
  source_url VARCHAR(2048) NOT NULL,
  source_host VARCHAR(255) NOT NULL,
  status VARCHAR(30) NOT NULL DEFAULT 'pending',
  discovered_listings INT UNSIGNED NOT NULL DEFAULT 0,
  last_crawled_at DATETIME NULL,
  last_error VARCHAR(500) NULL,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  PRIMARY KEY (id),
  KEY ix_broker_source_request (broker_index_request_id),
  KEY ix_broker_source_host (source_host),
  KEY ix_broker_source_status (status),
  CONSTRAINT fk_broker_source_request
    FOREIGN KEY (broker_index_request_id) REFERENCES broker_index_requests(id)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
