
BEGIN;

-----------------------------------------------------------------------
-- opinion
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "opinion" CASCADE;

CREATE TABLE "opinion"
(
    "id" serial NOT NULL,
    "name" VARCHAR(20) NOT NULL,
    "nick" VARCHAR(50) NOT NULL,
    "data" VARCHAR(1024) NOT NULL,
    "created_at" TIMESTAMP,
    PRIMARY KEY ("id")
);

COMMIT;
