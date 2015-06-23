# Speficications (phase 1: up to workshop in May 2014)

## General structure

 * Bulk upload
    * Template
    * XLS parser to tables-as-PHP-memory-arrays
    * Validator
       * Reads `bulk_valid.php`
       * Checks data
       * **Provides user feedback**
    * Upload to DB(s) inside transaction (`SET AUTOCOMMIT = 0; START 
      TRANSACTION; .... COMMIT;`)
 * One-by-one user interface
 * Database1 - scientific and user data
    * Schema (must be evolvable)
 * Database2 - internal tables
 * File store 
 * Name lookup, from ThePlantList

## Bulk upload process

### User page:

 1. Submit XLS file
 2. Zip files and name as... Upload with filezilla
 3. Enter filename: [......] and [SUBMIT]
    * get back report of image processing

### Backend image processing:

 * Zip photos into file - name as `user-date`.zip
 * Upload using filezilla to safe shared directory
 * They hit a link on site (after login), and give zip filename, and
   PHP grabs the zip file and _copies_ it and expands it to
   `/tmp/imgprocess`
 * All image files are found and converted to three sizes 1000 max
   dimension px, 500 px, 100 px and remamed
   `<md5sum>.<1000|500|100px>.jpg` and data stored in `img` table in
   DB (filename, user, hash, internal zip directory structure), and
   copied to `imgdata/` (all files in one dir).
 * Tmp files deleted
 
### Backend XLS processing

 * (Design template based on
   <http://xmalesia.info/ezdbdb/doc/ezdbdb_template.ods>) 
 * Upload XLS
 * Convert in PHP to data arrays in memory, one for each table
 * Read `bulk_valid.php` and validate.
    * E.g., all image filenames in `image` table from spreadsheet must
      already exist in DB, and vice versa
 * If valid, load to DB inside single transaction
 * Provide user feedback of errors, success.

### For training

 * use a standard short code for each person
 * determinations only come from them
