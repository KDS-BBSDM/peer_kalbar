# Guide for converting bulk spreadsheet entries to DB

 * Key `spreadsheet_column` → (Validation) → `DB.field`; Notes
 * Note: defaults are set in the DB
 * Algorithm: 
    * Read all lines of `Taxon`, and _for those that are referenced
      in_ `Plant`, _and_ do not have a _valid_ `db_id`, create new
      records (see below), storing the `taxon.id` values.
    * Read all lines of `Person`, and _for those that are referenced
      in_ `Plant`, _and_ do not have a _valid_ `db_id`, create new
      records (see below), storing the `person.id` values.
    * Read all lines of `Location`, and _for those that are referenced
      in_ `Plant`, create new records, storing the `locn.id` values.

## Sheet: Taxon

For each row, if `db_id` NOT present, create new `taxon` record

 * `unique_key`; ignore 
 * `morphotype` → (regex: `[A-Za-z0-9_]*`) → `taxon.morphotype`
 * `fam`, `gen`, `sp`, `auth`, `subtype`, `ssp`, `ssp_auth` → (Free
   text) → `taxon.fam`, `taxon.gen`, `taxon.sp`,
   `taxon.subtype`, `taxon.ssp`, `taxon.auth`
 
## Sheet: Person

For each row, if `db_id` NOT present, create new `person` record

 * `unique_key`; disregard 
 * `name`, `email`, `twitter`, `website` → (Free
   text) → `name`, `email`, `twitter`, `website`
 * `phone` → (No leading zero or +) → `phone`

## Location

 * `unique_id`; ignore
 * `long` → (Float) → `locn.longitude`
 * `lat` → (Float) → `locn.latitude`
 * `elev` → (Integer) → `locn.elev`
 * `geomorphology`, `locality`, `county`, `province`, `island`,
   `country`, `notes` → (Free text) → `locn.geomorph`,
   `locn.locality`, `locn.county`, `locn.province`, `locn.island`,
   `locn.country`, `locn.notes`

## Sheet: Plants

Automatically triggers creation of a _new_ `obs` and `det` record.

 * `unique_key`; temporary joining key, not entered into DB 
 * `date` → (Date) → `obs.date` 
 * `obs_by` → (existing `shortcode` in `Person` table) → `obs.personID` 
 * `locn` → () → `indiv.locnID`; _after_ creation of new location
 * `microhab` → (Free text) → `bos.microhab`
 * `plot` → (Free text) → `indiv.plot`
 * `tag` → (Free text) → `indiv.tag`
 * `habit` → (Valid enum value) → `obs.habit`
 * `dbh` → (Float) → `obs.dbh`; make sure the first digit of the
   decimal is preserved
 * `height` → (Float) → `obs.height`; make sure the first two digits
   of the decimal are preserved
 * `bud` → (`yes` or `no`) → `obs.bud`
 * `flower` → (`yes` or `no`) → `obs.flower`
 * `fruit` → (`yes` or `no`) → `obs.fruit`
 * `notes` → (Free text) → `obs.notes`
 * `det` → (existing `unique_key` in `Taxon` table); see Taxon table notes
 * `confid` → (Valid enum value) → `det.confid`
 * `det_by` → (existing `person.shortcode` in DB) → `det.personID`
 * `det_date` → (Date) → `det.date`
 * `det_using` → (Free text) → `det.using`
 * `det_notes` → (Free text) → `det.notes`

## Sheet: Photo

 * `filename` → (Unique for the given photographer) → `img.filename`
 * `tree_id` → (Valid `indiv.id` via lookup of created individual) →
   `img.indivID`
 * `photographer` → (Valid `person.id` via lookup of Person) →
   `img.personID`
 * `plant_part` → (Valid enum value) → `img.plantpart`
 * `notes` → (Free text) → `img`.`notes`

